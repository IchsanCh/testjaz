<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\ContactSubmission;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Produk', Product::count())
                ->icon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('Artikel Published', Article::published()->count())
                ->icon('heroicon-o-newspaper')
                ->color('info'),

            Stat::make('Pesan Belum Dibaca', ContactSubmission::where('is_read', false)->count())
                ->icon('heroicon-o-envelope')
                ->color(ContactSubmission::where('is_read', false)->count() > 0 ? 'danger' : 'gray'),
        ];
    }
}
