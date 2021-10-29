<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * authentication invalid response
     * @var array $authError
     */
    public $authError = [
        'message' => 'Invalid email/password',
        'errors' => [
            'email' => 'Invalid email/password',
            'password' => 'Invalid email/password'
        ]
    ];

    /**
     * Login user
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        /** @var User $user */
        $user = User::whereEmail($request->email)->firstOrFail();

        // check user credentials
        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('spa_token');
            return $this->sendResponse(['token' => $token->plainTextToken], 200);
        }
        // on auth error
        return $this->sendResponse( $this->authError, 422);
    }
}
