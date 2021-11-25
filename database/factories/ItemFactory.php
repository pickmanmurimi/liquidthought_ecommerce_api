<?php

namespace Database\Factories;

use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @property $id
 * @property $uuid
 * @property $name
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'name' => 'Lebron soldier ' . $this->faker->unique()->randomNumber('2'),
            'unit_price' => random_int(100, 300),
            'sku' => 'sku' . $this->faker->ean8(),
            'image_url' => $this->faker->unique()->randomElement([
                '/products/lebron1.png',
                '/products/lebron2.png',
                '/products/lebron3.png',
                '/products/lebron4.png',
                '/products/lebron5.png',
                '/products/lebron6.png',
                '/products/lebron7.png',
                '/products/lebron8.png',
                '/products/lebron9.png',
                '/products/lebron10.png',
            ]),
            'isAvailable' => true,
            'isSale' => false,
            'description' => $this->faker->paragraph(10),
            'currency' => 'ZAR',
            'item_category_id' =>  random_int(1, 4),
        ];
    }
}
