<?php

namespace Tests\Feature;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
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
    }

    /**
     * testing null password cannot be passed to the api
     */
    public function test_login_validates_fields()
    {
        $loginData = [
            'email' => 'email',
            'password' => '',
        ];

        $response = $this->postJson('api/v1/authentication/login', $loginData);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors' => ['password', 'email']]);
    }

    /**
     * can get currently authenticate user
     */
    public function test_can_get_logged_in_user()
    {
        // create user
        /** @var User $user */
        $user = User::factory()->create();
        Sanctum::actingAs( $user );

        $response = $this->getJson('api/v1/authentication/me');

        $response->assertStatus(200);
        $authenticated_user = json_decode($response->getContent())->data;
        $this->assertTrue( $authenticated_user->email === $user->email );
    }
}
