<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Mail\SendOrderCreatedMail;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Log;
use Mail;
use Throwable;

class CheckoutController extends Controller
{
    /**
     * check out an order.
     * @param CheckoutRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function checkout(CheckoutRequest $request): JsonResponse
    {
        /**
         * we will only be simulating the checkout process here,
         * we will just create an order and checkout.
         * The payment for the order will be handled by a "third party" :).
         */
        /** @var User $user */
        $user = Auth::user();
        /** @var Address $address */
        $address = $user->addresses()->whereUuid($request->address_uuid)->first();
        // create an order
        /** @var Order $order */
        $order = $address->orders()->create();
        // add items to that order
        $order->orderItems()->createMany($request->items);

        Mail::to($user)->send(new SendOrderCreatedMail($order, $user));

        return $this->sendSuccess('Added items to order!', 201);

    }
}
