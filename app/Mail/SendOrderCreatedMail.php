<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Order $order
     */
    public Order $order;

    /**
     * @var User $user
     */
    public  User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Order $order, User $user)
    {
        //
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Mail.OrderCreatedMail');
    }
}
