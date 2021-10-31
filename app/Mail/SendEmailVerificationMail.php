<?php

namespace App\Mail;

use App\Models\User;
use App\Models\VerificationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailVerificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User $user
     */
    public User $user;

    /**
     * url to the front end email verification page
     * @var string
     */
    public string $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( User $user, VerificationToken $verificationToken)
    {
        $this->user = $user;
        $this->url = config('app.frontend_url')
            . '/verify/' . $verificationToken->token . '/' . $verificationToken->uuid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Mail.EmailVerificationMail');
    }
}
