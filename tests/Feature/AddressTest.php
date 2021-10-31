<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * add address
     */
    public function test_can_add_address()
    {
        // create user
        /** @var User $user */
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $address = [
            'full_name' => $this->faker->name,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->city,
            'country' => $this->faker->country,
        ];

        $response = $this->postJson('api/v1/user/address', $address);
        $response->assertStatus(201);
        $this->assertCount(1, Address::all());
        $this->assertTrue(User::first()->addresses->first()->address === $address['address']);
        $this->assertTrue(Address::first()->addressable_type === User::class);
    }

    /**
     * user can get there addresses
     */
    public function test_can_get_user_addresses()
    {
        /** @var User $user */
        $user = User::factory()->hasAddresses(2)->create();
        Sanctum::actingAs($user);

        $response = $this->getJson('api/v1/user/address');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [[
            'uuid',
            'full_name',
            'address',
            'postal_code',
            'city',
            'state',
            'country',
        ]]]);
    }
}
