<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ItemsController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        /** @var Item $items */
        $items = Item::paginate(10);

        return ItemResource::collection($items);
    }

    /**
     * @param $uuid
     * @return ItemResource
     */
    public function show( $uuid ): ItemResource
    {
        /** @var Item $item */
        $item = Item::findUuid($uuid);

        return new ItemResource($item);
    }
}
