<?php

namespace App\Filament\Resources\SectionItems;

use App\Filament\Resources\SectionItems\Pages\CreateSectionItem;
use App\Filament\Resources\SectionItems\Pages\EditSectionItem;
use App\Filament\Resources\SectionItems\Pages\ListSectionItems;
use App\Filament\Resources\SectionItems\Schemas\SectionItemForm;
use App\Filament\Resources\SectionItems\Tables\SectionItemsTable;
use App\Models\SectionItem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SectionItemResource extends Resource
{
    protected static ?string $model = SectionItem::class;
    protected static string|UnitEnum|null $navigationGroup = 'Konten';
    protected static ?string $modelLabel = 'Item Konten';
    protected static ?string $pluralModelLabel = 'Item Konten';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    public static function form(Schema $schema): Schema
    {
        return SectionItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SectionItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSectionItems::route('/'),
            'create' => CreateSectionItem::route('/create'),
            'edit' => EditSectionItem::route('/{record}/edit'),
        ];
    }
}
