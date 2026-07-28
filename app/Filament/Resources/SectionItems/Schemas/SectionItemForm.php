<?php

namespace App\Filament\Resources\SectionItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SectionItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('section_id')
                    ->label('Bagian dari Section')
                    ->relationship('section', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('title')
                    ->label('Judul'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->maxSize(2048)
                    ->imageEditor(),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
