<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Motif')
                    ->required(),
                TextInput::make('material')
                    ->label('Bahan')
                    ->placeholder('Contoh: TR + TR'),
                TextInput::make('size_width')
                    ->label('Lebar (cm)')
                    ->numeric()
                    ->suffix('cm'),
                TextInput::make('size_length')
                    ->label('Panjang (cm)')
                    ->numeric()
                    ->suffix('cm'),
                TextInput::make('edition')
                    ->label('Edisi (opsional)')
                    ->placeholder('Contoh: Premium, Limited — kosongin kalau gak ada')
                    ->helperText('Kalau diisi, badge edisi bakal muncul di card produk. Kosongin kalau gak perlu.'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),

                Repeater::make('images')
                    ->relationship('images')
                    ->label('Foto Showcase')
                    ->orderColumn('sort_order')
                    ->reorderable()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['is_thumbnail'] ?? false ? '⭐ Thumbnail' : null)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->disk('public')
                            ->image()
                            ->maxSize(2048)
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),
                        Toggle::make('is_thumbnail')
                            ->label('Jadikan Thumbnail')
                            ->helperText('Dipakai buat tampilan card di landing page & halaman produk. Cuma boleh 1 per produk — nandain yang baru otomatis lepas status thumbnail foto lain.'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
