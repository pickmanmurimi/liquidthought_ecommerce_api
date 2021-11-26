<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Database\Factories\ItemCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ItemCategory
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read int|null $items_count
 * @method static \Database\Factories\ItemCategoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereUuid($value)
 * @mixin \Eloquent
 */
class ItemCategory extends Model
{
    use HasFactory, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return ItemCategoryFactory
     */
    protected static function newFactory(): ItemCategoryFactory
    {
        return ItemCategoryFactory::new();
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
