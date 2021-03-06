<?php

namespace App\Http\Resources;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $uuid
 * @property mixed $name
 * @property mixed $unit_price
 * @property mixed $sku
 * @property mixed $image_url
 * @property mixed $isAvailable
 * @property mixed $isSale
 * @property mixed $description
 * @property mixed $currency
 * @property ItemCategory $ItemCategory
 */
class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource ? [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'unit_price' => $this->unit_price,
            'sku' => $this->sku,
            'image_url' => $this->image_url,
            'isAvailable' => $this->isAvailable,
            'isSale' => $this->isSale,
            'description' => $this->description,
            'currency' => $this->currency,
            'ItemCategory' => new ItemCategoryResource( $this->ItemCategory ),
        ] : [];
    }
}
