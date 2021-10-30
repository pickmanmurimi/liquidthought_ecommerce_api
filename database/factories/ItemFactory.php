<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'unit_price' => random_int( 100, 300 ),
            'sku' => 'sku' . $this->faker->ean8(),
            'image_url' => $this->faker->imageUrl,
            'isAvailable' => true,
            'isSale' => false,
            'description' => $this->faker->paragraph,
            'currency' => 'ZAR'
        ];
    }
}
