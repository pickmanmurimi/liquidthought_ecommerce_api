<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $uuid
 * @property int $address_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Address $address
 * @property-read Collection|OrderItem[] $orderItems
 * @property-read int|null $order_items_count
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddressId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeletedAt($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUuid($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory, UsesUuid;

    /** @var array $fillable */
    public $fillable = [
        'user_id',
        'address_id',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }

    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * @return HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
