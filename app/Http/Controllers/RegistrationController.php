<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    /**
     * Registers a new user
     * @param RegistrationRequest $request
     * @return JsonResponse
     */
    public function register(RegistrationRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $this->sendSuccess('User registered!', 201);

        } catch (Exception $exception) {
            return $this->sendError('Whoops! something went wrong', 500);
        }

    }
}
