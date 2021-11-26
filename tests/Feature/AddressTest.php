<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\User;
use Auth;
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
     * set default address
     */
    public function test_can_set_default_address()
    {
        /** @var User $user */
        $this->authenticateUser();
        $address = Auth::user()->addresses->first();

        $response = $this->patchJson('api/v1/user/address/default/' . $address->uuid );
        $response->assertStatus(200);
        $this->assertTrue( Address::findUuid( $address->uuid )->default );
    }

    /**
     * user can get their addresses
     */
    public function test_can_get_user_addresses()
    {
        /** @var User $user */
        $this->authenticateUser();

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
