<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed $id
 * @property mixed $uuid
 * @property mixed $address
 * @property mixed $orderItems
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return $this->resource ? [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'addresses' => $this->address,
            'items' => ItemResource::collection($this->orderItems)
        ] : [];
    }
}
