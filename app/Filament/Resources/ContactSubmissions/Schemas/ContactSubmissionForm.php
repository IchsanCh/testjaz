<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    // Cuma dipakai buat modal "Lihat detail" (read-only), gak ada create/edit
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->disabled(),
                TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                Textarea::make('message')
                    ->label('Pesan')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}
