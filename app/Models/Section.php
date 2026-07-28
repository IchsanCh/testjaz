<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['key', 'title', 'body', 'image', 'is_visible'])]
class Section extends Model
{
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    // Panggil: Section::findByKey('tentang')
    public static function findByKey(string $key): ?self
    {
        return static::where('key', $key)->first();
    }
}
