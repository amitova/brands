<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'brand_name',
        'brand_image',
        'rating',
        'country_code',
    ];
    protected $primaryKey = 'brand_id';
    protected $dates = ['deleted_at'];

    // Get countries by country code
    public function scopeByCountryCode(Builder $query, $code): Builder
    {
        return $query->where('country_code', $code);
    }

    public function scopeDefaultBrandsList(Builder $query, $threshold)
    {
        return $query->where('rating', '>=', $threshold)
                    ->orderByDesc('rating');
    }

    public static function createBrand($data) {
        return self::create($data);
    }

   public static function deleteBrand($brandId)
    {
        $brand = self::find($brandId);
        if (!$brand) {
            return false;
        }

        return $brand->delete();
    }

    public static function updateBrand(Brand $brand, $data)
    {
        $brand->update($data);
        return $brand;
    }
}
