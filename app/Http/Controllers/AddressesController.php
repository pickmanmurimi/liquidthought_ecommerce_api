<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Log;

class AddressesController extends Controller
{
    /**
     * get user addresses
     */
    public function index(): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = Auth::user();

        return AddressResource::collection($user->addresses()->orderByDesc('created_at')->get());
    }

    /**
     * @param CreateAddressRequest $request
     * @return JsonResponse
     */
    public function store(CreateAddressRequest $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            /** create address */
            $user->addresses()->create(
                [
                    'full_name' => $request->full_name,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                ]
            );

            return $this->sendSuccess('Address added!', 201);

        } catch (Exception $exception) {
            Log::error($exception);
            return $this->sendError();
        }
    }
}
