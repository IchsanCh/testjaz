<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
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
