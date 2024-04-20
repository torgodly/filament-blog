<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Resources\CategoryResource\RelationManagers\PostsRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('filament-blog::category.navigation.group');
    }
    public static function getLabel(): string
    {
        return __('filament-blog::category.navigation.label');
    }
    public static function getPluralLabel(): string
    {
        return __('filament-blog::category.navigation.plural-label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-blog::category.navigation.model-label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Category::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-blog::category.table.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')->label(__('filament-blog::category.table.slug')),
                Tables\Columns\TextColumn::make('posts_count')
                    ->label(__('filament-blog::category.table.posts_count'))
                    ->badge()
                    ->counts('posts'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::category.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::category.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            Section::make(__('filament-blog::category.infolist.label'))
                ->schema([
                    TextEntry::make('name')->label(__('filament-blog::category.infolist.name')),
                    TextEntry::make('slug')->label(__('filament-blog::category.infolist.slug')),
                ])->columns(2)
                ->icon('heroicon-o-square-3-stack-3d'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\ListCategories::route('/'),
            'edit' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\EditCategory::route('/{record}/edit'),
            'view' => \Firefly\FilamentBlog\Resources\CategoryResource\Pages\ViewCategory::route('/{record}'),
        ];
    }
}
