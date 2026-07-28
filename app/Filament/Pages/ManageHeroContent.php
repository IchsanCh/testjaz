<?php

namespace App\Filament\Pages;

use UnitEnum;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class ManageHeroContent extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Pengaturan Hero';

    protected static ?string $title = 'Pengaturan Hero';
    protected string $view = 'filament.pages.manage-hero-content';
}
