<?php

namespace App\Filament\Resources\ArticleCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->live(debounce: 500)
                    ->afterStateUpdated(function (?string $state, callable $set) {
                        $set('slug', Str::slug($state ?? ''));
                    })
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->dehydrated(),
            ]);
    }
}
