<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Database\Factories\ItemFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Item
 *
 * @method static ItemFactory factory(...$parameters)
 * @method static Builder|Item newModelQuery()
 * @method static Builder|Item newQuery()
 * @method static Builder|Item query()
 * @mixin Eloquent
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property ItemFactory $ItemCategory
 * @method static Builder|Item whereCreatedAt($value)
 * @method static Builder|Item whereCurrency($value)
 * @method static Builder|Item whereDeletedAt($value)
 * @method static Builder|Item whereDescription($value)
 * @method static Builder|Item whereId($value)
 * @method static Builder|Item whereImageUrl($value)
 * @method static Builder|Item whereIsAvailable($value)
 * @method static Builder|Item whereIsSale($value)
 * @method static Builder|Item whereName($value)
 * @method static Builder|Item whereSku($value)
 * @method static Builder|Item whereUnitPrice($value)
 * @method static Builder|Item whereUpdatedAt($value)
 * @method static Builder|Item whereUuid($value)
 * @property int $item_category_id
 * @method static Builder|Item whereItemCategoryId($value)
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
     * @var string[] $casts
     */
    protected $casts = [
        'isSale' => 'boolean',
        'isAvailable' => 'boolean',
    ];

    /**
     * @return ItemFactory
     */
    public function newFactory(): ItemFactory
    {
        return new ItemFactory();
    }

    /**
     * @return BelongsTo
     */
    public function ItemCategory(): BelongsTo
    {
        return $this->belongsTo(ItemCategory::class);
    }
}
