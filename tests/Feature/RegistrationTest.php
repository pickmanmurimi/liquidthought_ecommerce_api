<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Tests if a user can register
     *
     * @return void
     */
    public function test_user_can_register()
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
        $this->assertCount(1, User::all());
    }
}
