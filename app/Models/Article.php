<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable(['article_category_id', 'title', 'slug', 'cover_image', 'content', 'status'])]
class Article extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    // Meta title auto dari judul, gak perlu diisi manual dari admin
    public function getMetaTitleAttribute(): string
    {
        return $this->title;
    }

    // Meta description auto dari isi konten, di-strip tag & dipotong ~155 karakter
    public function getMetaDescriptionAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 155);
    }

    // Excerpt buat card preview di listing artikel, dipotong lebih pendek
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 120);
    }
}
