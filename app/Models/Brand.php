<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'brand_image',
        'rating',
        'country_code',
    ];

    // Get countries by country code
    public function scopeByCountryCode(Builder $query, string $code): Builder
    {
        return $query->where('country_code', $code);
    }

    public function scopeDefaultBrandsList(Builder $query, $threshold): Builder
    {
        return $query->where('rating', '>=', $threshold)
                    ->orderByDesc('rating');
    }
}
