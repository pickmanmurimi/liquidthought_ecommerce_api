<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed $uuid
 * @property mixed $full_name
 * @property mixed $address
 * @property mixed $postal_code
 * @property mixed $city
 * @property mixed $state
 * @property mixed $country
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->resource ? [
            'uuid' => $this->uuid,
            'full_name' => $this->full_name,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
        ] : [];
    }
}
