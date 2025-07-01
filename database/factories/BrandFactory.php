<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Apple','Google','Samsung','Nike','Adidas','Sony','BMW','Amazon','Coca-Cola','Toyota'];
        $countries = ['US','DE','JP','KR', null];

        return [
            'brand_name'   => $this->faker->unique()->company(),
            'brand_image'  => $this->faker->imageUrl(150, 150, 'technics', true),
            'rating'       => $this->faker->numberBetween(1, 5),
            'country_code' => $this->faker->randomElement($countries),
        ];
    }
}
