<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * user can check out
     */
    public function test_user_can_checkout()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
