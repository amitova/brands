<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(50)->create();

        Brand::create([
            'brand_name'   => 'Default Brand',
            'brand_image'  => 'https://via.placeholder.com/150?text=Default',
            'rating'       => 2,
            'country_code' => null,
        ]);
    }
}
