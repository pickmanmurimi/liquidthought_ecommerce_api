<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use URL;

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

    /**
     * Tests if a user can verify their email
     *
     * @return void
     */
    public function test_user_can_verify_email()
    {
        $user = $this->authenticateUser();
        $verificationToken = $user->createVerificationToken();

        $response = $this->getJson(
            URL::route('auth::verifyEmail',
                ['token' => $verificationToken->token, 'uuid' => $verificationToken->uuid])
        );

        $response->assertStatus(200);
        $this->assertNotNull( User::first()->email_verified_at);
    }

    /**
     * Tests if a user can resend the verification token
     *
     * @return void
     */
    public function test_user_can_resend_verify_email_mail()
    {
        $user = $this->authenticateUser();
        $verificationToken = $user->createVerificationToken();

        $response = $this->getJson('api/v1/authentication/resend-verification');

        $response->assertStatus(200);
        $this->assertNotNull( User::first()->email_verified_at);
    }
}
