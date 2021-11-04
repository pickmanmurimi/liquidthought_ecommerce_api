<?php

namespace App\Http\Controllers;

use App\Mail\ResendEmailVerificationMail;
use App\Models\User;
use App\Models\VerificationToken;
use Auth;
use Illuminate\Http\JsonResponse;
use Mail;

class EmailVerificationController extends Controller
{

    /**
     * verify the users email
     *
     * @param $token
     * @param $uuid
     * @return JsonResponse
     */
    public function verifyEmail($token, $uuid): JsonResponse
    {
        /** @var VerificationToken $verificationToken */
        $verificationToken = VerificationToken::whereUuid($uuid)->first();

        if (!$verificationToken) {
            return $this->sendError('Could not find your token!', 422);
        }

        if ($verificationToken->token === $token && $verificationToken->expires_at->isFuture()) {
            $verificationToken->user()->update(['email_verified_at' => now()]);
            $verificationToken->delete();
            return $this->sendSuccess('Email verified!');
        }

        return $this->sendError('Verification token expired!', 422);
    }

    /**
     * resend the email verification
     * @return JsonResponse
     */
    public function resendVerifyEmail(): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();

        // check if user was already verified
        if ($user->email_verified_at !== null) {
            // create new verification token and mail it
            $verificationToken = $user->createVerificationToken();
            Mail::to($user)->send(new ResendEmailVerificationMail($user, $verificationToken));

            return $this->sendSuccess('Email verification sent!', 200);
        }

        return $this->sendError('Email already verified!', 422);
    }
}
