<?php

namespace Firefly\FilamentBlog\Resources\CategoryResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public static function getModelLabel(): string
    {
        return __('filament-blog::category.relationship-manager.posts.model-label');
    }

    protected function getTableHeading(): string|Htmlable|null
    {
        return __('filament-blog::category.relationship-manager.posts.heading');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(Post::getForm());
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-blog::category.relationship-manager.posts.title'))
                    ->limit(40)
                    ->description(function (Post $record) {
                        return Str::limit($record->sub_title);
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-blog::category.relationship-manager.posts.status'))
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
