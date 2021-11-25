<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * get items
     */
    public function test_can_get_items()
    {
        Item::factory()->count(10)->create();

        $response = $this->getJson('api/v1/items/items');

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [
            [
                'uuid',
                'name',
                'unit_price',
                'sku',
                'image_url',
                'isAvailable',
                'isSale',
                'description',
                'currency',
                'ItemCategory'
            ]
        ]]);
    }

    /**
     * get single item
     */
    public function test_can_get_single_item()
    {
        $item = Item::factory()->count(10)->create()->first();

        $response = $this->getJson('api/v1/items/items/' . $item->uuid);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [
            'uuid',
            'name',
            'unit_price',
            'sku',
            'image_url',
            'isAvailable',
            'isSale',
            'description',
            'currency',
            'ItemCategory'
        ]]);
    }
}
