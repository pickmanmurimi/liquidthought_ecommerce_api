<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Item
 *
 * @method static \Database\Factories\ItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasFactory, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name',
        'unit_price',
        'sku',
        'image_url',
        'isAvailable',
        'isSale',
        'description',
        'currency'
    ];

    /**
     * @return ItemFactory
     */
    public function newFactory(): ItemFactory
    {
        return new ItemFactory();
    }
}
