<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['section_key', 'title', 'description', 'image', 'sort_order'])]
class SectionItem extends Model
{
    // Panggil: SectionItem::forSection('proses')
    public function scopeForSection($query, string $sectionKey)
    {
        return $query->where('section_key', $sectionKey)->orderBy('sort_order');
    }
}
