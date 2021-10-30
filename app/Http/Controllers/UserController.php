<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Auth;

class UserController extends Controller
{
    /**
     * get currently authenticated user
     */
    public function me(): UserResource
    {
        return (new UserResource(Auth::user()));
    }
}
