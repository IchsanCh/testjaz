<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label('Dibaca?')
                    ->boolean(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Masuk Pada')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_read')
                    ->label('Status Baca')
                    ->trueLabel('Sudah Dibaca')
                    ->falseLabel('Belum Dibaca'),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Lihat'),
                Action::make('reply')
                    ->label('Balas via WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record) => $record->whatsapp_url)
                    ->openUrlInNewTab(),
                Action::make('replyEmail')
                    ->label('Balas via Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(fn ($record) => $record->email_url)
                    ->visible(fn ($record) => filled($record->email))
                    ->openUrlInNewTab(),
                Action::make('toggleRead')
                    ->label(fn ($record) => $record->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn ($record) => $record->update(['is_read' => ! $record->is_read])),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
