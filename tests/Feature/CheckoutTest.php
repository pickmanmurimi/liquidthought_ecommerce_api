<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * user can check out
     */
    public function test_user_can_checkout()
    {
        /** @var User $user */
        $user = $this->authenticateUser();
        /** @var Item $item */
        $item = Item::factory()->count(3)->create();

        $checkoutData = [
            'items' => [
                ['item_id' => $item->first()->id, 'quantity' => 2],
                ['item_id' => $item[1]->id, 'quantity' => 1]
            ],
            'address_uuid' => $user->addresses->first()->uuid,
        ];

        $response = $this->postJson('api/v1/items/checkout', $checkoutData);

        $response->assertStatus(201);
    }

    /**
     * user can get orders
     */
    public function test_user_can_get_orders()
    {
        /** @var User $user */
        $user = $this->authenticateUser();
        /** @var Item $item */
        $item = Item::factory()->count(3)->create();

        $checkoutData = [
            'items' => [
                ['item_id' => $item->first()->id, 'quantity' => 2],
                ['item_id' => $item[1]->id, 'quantity' => 1]
            ],
            'address_uuid' => $user->addresses->first()->uuid,
        ];
        $this->postJson('api/v1/items/checkout', $checkoutData);

        $response = $this->getJson('api/v1/items/orders', $checkoutData);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [
            ['id',
                'uuid',
                'address',
                'orderItems' => [
                    [
                        'id',
                        'uuid',
                        'quantity',
                        'item' => [
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
                    ]
                ],
            ]
        ]]);
    }
}
