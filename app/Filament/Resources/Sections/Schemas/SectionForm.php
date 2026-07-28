<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Kunci Section')
                    ->helperText('Contoh: tentang, proses, kenapa_pilih — dipakai kode buat manggil section ini, jangan diubah sembarangan kalau section sudah dipakai di halaman')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('title')
                    ->label('Judul'),
                Textarea::make('body')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->maxSize(2048)
                    ->imageEditor(),
                Toggle::make('is_visible')
                    ->label('Tampilkan di Halaman?')
                    ->default(true),
            ]);
    }
}
