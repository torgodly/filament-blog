<?php

namespace Firefly\FilamentBlog\Resources\PostResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Resources\PostResource;
use Firefly\FilamentBlog\Tables\Columns\UserPhotoName;
use Illuminate\Contracts\Support\Htmlable;

class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function getNavigationLabel(): string
    {
        return __('filament-blog::post.sub-navigation.post-comments.label');
    }

    public function getTitle(): string|Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return __('filament-blog::post.sub-navigation.post-comments.label');
    }

    public function getBreadcrumb(): string
    {
        return __('filament-blog::post.sub-navigation.post-comments.bread-crumb');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.form.user'))
                    ->relationship('user', 'name')
                    ->required(),
                Textarea::make('comment')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.form.comment'))
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Toggle::make('approved')->label(__('filament-blog::post.sub-navigation.post-comments.form.approved')),
            ])
            ->columns(1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('filament-blog::post.sub-navigation.post-comments.table.model-label'))
            ->pluralModelLabel(__('filament-blog::post.sub-navigation.post-comments.table.plural-model-label'))
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.table.comment'))
                    ->searchable(),
                UserPhotoName::make('user')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.table.commented-by')),
                Tables\Columns\ToggleColumn::make('approved')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.form.approved'))
                    ->beforeStateUpdated(function ($record, $state) {
                        if ($state) {
                            $record->approved_at = now();
                        } else {
                            $record->approved_at = null;
                        }

                        return $state;
                    }),
                Tables\Columns\TextColumn::make('approved_at')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.table.approved-at'))
                    ->placeholder(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.fields.not-approved'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('filament-blog::post.sub-navigation.post-comments.filters.user'))
                    ->relationship('user', config('filamentblog.user.columns.name'))
                    ->searchable()
                    ->preload()
                    ->multiple(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.label'))
                ->schema([
                    TextEntry::make('user.name')
                        ->label(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.fields.commented-by')),
                    TextEntry::make('comment')->label(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.fields.comment')),
                    TextEntry::make('created_at')->label(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.fields.created_at')),
                    TextEntry::make('approved_at')->label('Approved At')->placeholder(__('filament-blog::post.sub-navigation.post-comments.infolist.sections.comment.fields.not-approved'))->label(__('filament-blog::post.sub-navigation.post-comments.table.approved-at')),

                ])
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),
        ]);
    }
}
