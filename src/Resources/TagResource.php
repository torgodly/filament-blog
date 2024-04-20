<?php

namespace Firefly\FilamentBlog\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Tag;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 2;


    public static function getNavigationGroup(): ?string
    {
        return __('filament-blog::tag.navigation.group');
    }
    public static function getLabel(): string
    {
        return __('filament-blog::tag.navigation.label');
    }
    public static function getPluralLabel(): string
    {
        return __('filament-blog::tag.navigation.plural-label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-blog::tag.navigation.model-label');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema(Tag::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-blog::tag.table.name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament-blog::tag.table.slug')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-blog::tag.table.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament-blog::tag.table.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Firefly\FilamentBlog\Resources\TagResource\Pages\ListTags::route('/'),
            'edit' => \Firefly\FilamentBlog\Resources\TagResource\Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
