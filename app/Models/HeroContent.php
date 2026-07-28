<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['headline', 'subheadline', 'image'])]
class HeroContent extends Model
{
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
