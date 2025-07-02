<?php

namespace App\Services;
use App\Models\Brand;

class BrandService {
    public function createBrand($data) {
        return Brand::createBrand($data);
    }

    public function updateBrand(Brand $brand, $data)
    {
        return Brand::updateBrand($brand, $data);
    }

    public function deleteBrand($brandId)
    {
        return Brand::deleteBrand($brandId);
    }

    public function topList($country, $threshold){

        $list = Brand::byCountryCode($country)
                 ->defaultBrandsList($threshold)
                 ->get();

        if ($list->isEmpty()) {
            $list = Brand::defaultBrandsList($threshold)->get();
        }
        return $list;
    }
}
