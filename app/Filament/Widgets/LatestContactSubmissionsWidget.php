<?php

namespace App\Filament\Widgets;

use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestContactSubmissionsWidget extends BaseWidget
{
    protected static ?string $heading = 'Pesan Masuk Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactSubmission::query()
                    ->where('is_read', false)
                    ->latest()
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Nama'),
                TextColumn::make('whatsapp_number')
                    ->label('Nomor WhatsApp'),
                TextColumn::make('message')
                    ->label('Pesan')
                    ->limit(60),
                TextColumn::make('created_at')
                    ->label('Masuk Pada')
                    ->since(),
            ])
            ->recordActions([
                Action::make('reply')
                    ->label('Balas via WhatsApp')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn (ContactSubmission $record) => $record->whatsapp_url)
                    ->openUrlInNewTab(),
                Action::make('replyEmail')
                    ->label('Balas via Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->url(fn (ContactSubmission $record) => $record->email_url)
                    ->visible(fn (ContactSubmission $record) => filled($record->email))
                    ->openUrlInNewTab(),
                Action::make('tandaiDibaca')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check-circle')
                    ->action(fn (ContactSubmission $record) => $record->update(['is_read' => true])),
            ])
            ->paginated(false);
    }
}
