<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
use Filament\Support\Icons\Heroicon;

class ManageSiteSettings extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $title = 'Pengaturan Situs';
    protected string $view = 'filament.pages.manage-site-settings';
}
