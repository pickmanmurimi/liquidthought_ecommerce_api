<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Mail\SendEmailVerificationMail;
use App\Models\User;
use App\Models\VerificationToken;
use Exception;
use Hash;
use Illuminate\Http\JsonResponse;
use Log;
use Mail;

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

            $verificationToken = $user->createVerificationToken();

            // send email verification
            Mail::to($user)->send(new SendEmailVerificationMail($user, $verificationToken));

            return $this->sendSuccess('User registered!', 201);

        } catch (Exception $exception) {
            Log::error($exception);
            return $this->sendError('Whoops! something went wrong', 500);
        }

    }
}
