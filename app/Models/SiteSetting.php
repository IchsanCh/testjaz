<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'app_name',
    'logo',
    'whatsapp_number',
    'email',
    'address',
    'default_meta_title',
    'default_meta_description',
    'default_og_image',
    'owner_name',
    'owner_quote',
])]
class SiteSetting extends Model
{
    // Singleton: cuma ada 1 baris (id 1). Panggil lewat SiteSetting::current()
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
