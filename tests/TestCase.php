<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * authenticate a test user
     * adds 2 addresses to the user by default
     */
    public function authenticateUser()
    {
        $user = User::factory()->hasAddresses(2)->create();
        Sanctum::actingAs($user);

        return $user;
    }
}
