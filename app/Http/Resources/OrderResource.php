<?php

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property mixed $id
 * @property mixed $uuid
 * @property mixed $address
 * @property OrderItem $orderItems
 * @property mixed $created_at
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
            'address' => $this->address,
            'orderItems' => OrderItemResource::collection($this->orderItems),
            'created_at' => $this->created_at->format('d M Y H:i:s'),
        ] : [];
    }
}
