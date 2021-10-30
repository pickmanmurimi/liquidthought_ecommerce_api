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
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property float $unit_price
 * @property string $sku
 * @property string $image_url
 * @property int $isAvailable
 * @property int $isSale
 * @property string $description
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereIsAvailable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereIsSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUuid($value)
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
