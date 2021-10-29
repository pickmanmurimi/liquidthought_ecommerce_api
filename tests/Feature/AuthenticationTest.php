<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use WithFaker;

    /**
     * Tests if a user can log in
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $registrationData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $response = $this->postJson('api/v1/authentication/register', $registrationData);

        $response->assertStatus(201);
    }
}
