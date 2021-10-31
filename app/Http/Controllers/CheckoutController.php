<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Log;
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
         * we just assume creating an order is checking out.
         */
        try {
            DB::beginTransaction();

            /** @var User $user */
            $user = Auth::user();
            /** @var Address $address */
            $address = $user->addresses()->whereUuid($request->address_uuid)->first();
            // create an order
            /** @var Order $order */
            $order = $address->orders()->create();
            // add items to that order
            $order->orderItems()->createMany($request->items);

            DB::commit();
            return $this->sendSuccess('Added items to order!', 201);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return $this->sendError();
        }
    }
}
