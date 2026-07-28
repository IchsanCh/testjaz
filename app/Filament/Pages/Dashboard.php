<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestContactSubmissionsWidget;
use App\Filament\Widgets\OverviewStatsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        return [
            OverviewStatsWidget::class,
            LatestContactSubmissionsWidget::class,
        ];
    }

    public function getColumns(): int|array
    {
        return 1;
    }
}
