<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'app_name',
    'whatsapp_number',
    'email',
    'address',
    'latitude',
    'longitude',
    'default_meta_title',
    'default_meta_description',
    'default_og_image',
    'owner_name',
    'owner_quote',
])]
class SiteSetting extends Model
{
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    // Singleton: cuma ada 1 baris (id 1). Panggil lewat SiteSetting::current()
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    // Normalisasi nomor WA apapun formatnya diketik admin (08xx, 8xx, +62xx,
    // ada spasi/strip atau nggak) -> disimpen konsisten digit doang diawali "62".
    // Ini yang dipake langsung buat link wa.me (emang harus digit polos tanpa +/spasi).
    public function setWhatsappNumberAttribute(?string $value): void
    {
        $digits = preg_replace('/\D+/', '', (string) $value) ?? '';

        if ($digits === '') {
            $this->attributes['whatsapp_number'] = null;

            return;
        }

        if (str_starts_with($digits, '620')) {
            // kasus "+62" diketik bareng "0" trunk-nya, misal 62085601112291 -> buang 0-nya
            $digits = '62'.substr($digits, 3);
        } elseif (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        } elseif (! str_starts_with($digits, '62')) {
            $digits = '62'.$digits;
        }

        $this->attributes['whatsapp_number'] = $digits;
    }

    // Buat ditampilin di view: "628560111291" -> "+62 8560-1112-91"
    // (dikelompokin 4 digit, sisa terakhir ikut berapa aja panjangnya)
    public function getWhatsappNumberFormattedAttribute(): ?string
    {
        if (! $this->whatsapp_number) {
            return null;
        }

        $countryCode = substr($this->whatsapp_number, 0, 2);
        $rest = substr($this->whatsapp_number, 2);

        $groups = [];
        while ($rest !== '') {
            $groups[] = substr($rest, 0, 4);
            $rest = substr($rest, 4);
        }

        return "+{$countryCode} ".implode('-', $groups);
    }

    // Link Google Maps siap-pakai kalau koordinatnya keisi, null kalau belum
    public function getGoogleMapsUrlAttribute(): ?string
    {
        if ($this->latitude === null || $this->longitude === null) {
            return null;
        }

        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }
}
