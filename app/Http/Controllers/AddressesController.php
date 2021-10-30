<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use App\Models\User;
use Auth;

class AddressesController extends Controller
{
    /**
     * @param CreateAddressRequest $request
     */
    public function store(CreateAddressRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Address $address */
        $address = $user->addresses()->create(
            [
                'full_name' => $request->full_name,
                'address' => $request->address,
                'postal_code' => $request->postal_code,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
            ]
        );
    }
}
