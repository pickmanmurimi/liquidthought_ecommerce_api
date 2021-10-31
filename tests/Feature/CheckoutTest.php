<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * user can check out
     */
    public function test_user_can_checkout()
    {
        $this->authenticateUser();

        $response = $this->postJson('api/v1/items/checkout');

        $response->assertStatus(200);
    }
}
