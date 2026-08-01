<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSiteSettings extends Page implements HasSchemas
{
    use InteractsWithFormActions;
    use InteractsWithSchemas;

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $title = 'Pengaturan Situs';
    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('app_name')
                    ->label('Nama Aplikasi/Situs')
                    ->required(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->maxSize(2048)
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                        null, // biarin bebas/gak dipaksa crop
                    ]),
                TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email(),
                TextInput::make('address')
                    ->label('Alamat'),
                TextInput::make('default_meta_title')
                    ->label('Meta Title Default'),
                Textarea::make('default_meta_description')
                    ->label('Meta Description Default'),
                FileUpload::make('default_og_image')
                    ->label('Gambar OG Default')
                    ->image()
                    ->disk('public')
                    ->maxSize(2048), // maks 2MB
                TextInput::make('owner_name')
                    ->label('Nama Owner'),
                Textarea::make('owner_quote')
                    ->label('Moto/Quote Owner'),
            ]);
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $setting = SiteSetting::current();
        $setting->update($this->form->getState());

        Notification::make()
            ->title('Pengaturan situs berhasil disimpan')
            ->success()
            ->send();
    }
}
