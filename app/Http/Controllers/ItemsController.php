<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ItemsController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $paginate = $request->input('items', 10);
        /** @var Item $items */
        $items = Item::with('ItemCategory')->inRandomOrder()->paginate($paginate);

        return ItemResource::collection($items);
    }

    /**
     * @param $uuid
     * @return ItemResource
     */
    public function show($uuid): ItemResource
    {
        /** @var Item $item */
        $item = Item::findUuid($uuid);

        return new ItemResource($item);
    }
}
