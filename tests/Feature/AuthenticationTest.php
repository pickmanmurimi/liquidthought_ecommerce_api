<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Users login.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        // create user
        /** @var User $user */
        $user = User::factory()->create();

        $loginData = [
            'email' => $user->email,
            'password' => 'secret',
        ];

        $response = $this->postJson('api/v1/authentication/login', $loginData);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'success']);
        //TODO show exact response
    }

    /**
     * testing null password cannot be passed to the api
     */
    public function test_password_cannot_be_empty()
    {
        // create user
        /** @var User $user */
        $user = User::factory()->create();

        $loginData = [
            'email' => $user->email,
            'password' => '',
        ];

        $response = $this->postJson('api/v1/authentication/login', $loginData);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors' => ['password']]);
    }
}
