<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['product_id', 'image', 'is_thumbnail', 'sort_order'])]
class ProductImage extends Model
{
    protected function casts(): array
    {
        return [
            'is_thumbnail' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Jaga-jaga: cuma boleh ada 1 foto yang jadi thumbnail per produk.
    // Begitu satu foto ditandain thumbnail, foto lain di produk yang sama otomatis dilepas statusnya.
    protected static function booted(): void
    {
        static::saved(function (ProductImage $image) {
            if ($image->is_thumbnail) {
                static::where('product_id', $image->product_id)
                    ->where('id', '!=', $image->id)
                    ->update(['is_thumbnail' => false]);
            }
        });
    }
}
