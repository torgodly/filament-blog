<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Resources\PostResource\Pages\EditPost;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ManaePostSeoDetail;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ManagePostComments;
use Firefly\FilamentBlog\Resources\PostResource\Pages\ViewPost;
use Firefly\FilamentBlog\Resources\PostResource\Widgets\BlogPostPublishedChart;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-minus';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?int $navigationSort = 3;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-blog::post.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-blog::post.navigation.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-blog::post.navigation.plural-label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-blog::post.navigation.model-label');
    }

    public static function getNavigationBadge(): ?string
    {
        return Post::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Post::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::post.table.title'))
                    ->description(function (Post $record) {
                        return Str::limit($record->sub_title, 40);
                    })
                    ->searchable()->limit(20),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-blog::post.table.status'))
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                Tables\Columns\ImageColumn::make('cover_photo_path')->label(__('filament-blog::post.table.cover-photo')),

                UserPhotoName::make('user')
                    ->label(__('filament-blog::post.table.author')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::post.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::post.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('filament-blog::post.filter.author'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make(__('filament-blog::post.infolist.sections.post.label'))
                ->schema([
                    Fieldset::make(__('filament-blog::post.infolist.sections.post.field-sets.general.label'))
                        ->schema([
                            TextEntry::make('title')->label(__('filament-blog::post.infolist.sections.post.field-sets.general.fields.title')),
                            TextEntry::make('slug')->label(__('filament-blog::post.infolist.sections.post.field-sets.general.fields.slug')),
                            TextEntry::make('sub_title')->label(__('filament-blog::post.infolist.sections.post.field-sets.general.fields.sub-title')),
                        ]),
                    Fieldset::make(__('filament-blog::post.infolist.sections.post.field-sets.publish-information.label'))
                        ->schema([
                            TextEntry::make('status')->label(__('filament-blog::post.infolist.sections.post.field-sets.publish-information.fields.status'))
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')
                                ->label(__('filament-blog::post.infolist.sections.post.field-sets.publish-information.fields.published-at'))
                                ->visible(function (Post $record) {
                                    return $record->status === PostStatus::PUBLISHED;
                                }),

                            TextEntry::make('scheduled_for')
                                ->label(__('filament-blog::post.infolist.sections.post.field-sets.publish-information.fields.scheduled-for'))
                                ->visible(function (Post $record) {
                                    return $record->status === PostStatus::SCHEDULED;
                                }),
                        ]),
                    Fieldset::make(__('filament-blog::post.infolist.sections.post.field-sets.description.label'))
                        ->schema([
                            TextEntry::make('body')
                                ->label(__('filament-blog::post.infolist.sections.post.field-sets.description.fields.body'))
                                ->html()
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewPost::class,
            ManaePostSeoDetail::class,
            ManagePostComments::class,
            EditPost::class,
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //            \Firefly\FilamentBlog\Resources\PostResource\RelationManagers\SeoDetailRelationManager::class,
            //            \Firefly\FilamentBlog\Resources\PostResource\RelationManagers\CommentsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            BlogPostPublishedChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Firefly\FilamentBlog\Resources\PostResource\Pages\ListPosts::route('/'),
            'create' => \Firefly\FilamentBlog\Resources\PostResource\Pages\CreatePost::route('/create'),
            'edit' => \Firefly\FilamentBlog\Resources\PostResource\Pages\EditPost::route('/{record}/edit'),
            'view' => \Firefly\FilamentBlog\Resources\PostResource\Pages\ViewPost::route('/{record}'),
            'comments' => \Firefly\FilamentBlog\Resources\PostResource\Pages\ManagePostComments::route('/{record}/comments'),
            'seoDetail' => \Firefly\FilamentBlog\Resources\PostResource\Pages\ManaePostSeoDetail::route('/{record}/seo-details'),
        ];
    }
}
