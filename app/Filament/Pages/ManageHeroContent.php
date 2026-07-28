<?php

namespace App\Filament\Pages;

use App\Models\HeroContent;
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

class ManageHeroContent extends Page implements HasSchemas
{
    use InteractsWithFormActions;
    use InteractsWithSchemas;

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;
    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Konten Hero';

    protected static ?string $title = 'Konten Hero';
    protected string $view = 'filament.pages.manage-hero-content';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(HeroContent::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                TextInput::make('headline')
                    ->label('Headline')
                    ->required(),
                Textarea::make('subheadline')
                    ->label('Subheadline'),
                FileUpload::make('image')
                    ->label('Gambar Hero')
                    ->image()
                    ->maxSize(2048)
                    ->imageEditor(),
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
        $hero = HeroContent::current();
        $hero->update($this->form->getState());

        Notification::make()
            ->title('Konten hero berhasil disimpan')
            ->success()
            ->send();
    }
}
