<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('article_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->label('Judul')
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
                FileUpload::make('cover_image')
                    ->label('Gambar Sampul')
                    ->image()
                    ->disk('public')
                    ->maxSize(2048)
                    ->imageEditor()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                                            'draft' => 'Draft',
                                            'published' => 'Published',
                                        ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
