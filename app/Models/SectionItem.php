<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['section_id', 'title', 'description', 'image', 'sort_order'])]
class SectionItem extends Model
{
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
