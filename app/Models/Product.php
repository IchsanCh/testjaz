<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['product_category_id', 'name', 'material', 'size_width', 'size_length', 'edition', 'description', 'sort_order'])]
class Product extends Model
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // Foto yang ditandain thumbnail; kalau belum ada yang ditandain, fallback ke foto pertama
    public function getThumbnailAttribute(): ?ProductImage
    {
        return $this->images->firstWhere('is_thumbnail', true) ?? $this->images->first();
    }

    // Path gambar thumbnail doang, gampang dipake di ImageColumn Filament / <img> Blade
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail?->image;
    }

    // Format tampilan: "Bahan TR + TR · Ukuran 210 × 128 cm"
    public function getSpecLabelAttribute(): ?string
    {
        $parts = [];

        if ($this->material) {
            $parts[] = "Bahan {$this->material}";
        }

        if ($this->size_width && $this->size_length) {
            $parts[] = "Ukuran {$this->size_width} × {$this->size_length} cm";
        }

        return $parts ? implode(' · ', $parts) : null;
    }
}   