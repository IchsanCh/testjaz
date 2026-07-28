<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['key', 'title', 'body', 'image', 'is_visible'])]
class Section extends Model
{
    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(SectionItem::class)->orderBy('sort_order');
    }

    // Panggil: Section::findByKey('proses')
    public static function findByKey(string $key): ?self
    {
        return static::where('key', $key)->first();
    }
}
