<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Database\Factories\AddressFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Address
 *
 * @property-read User $user
 * @method static Builder|Address newModelQuery()
 * @method static Builder|Address newQuery()
 * @method static Builder|Address query()
 * @mixin Eloquent
 * @method static AddressFactory factory(...$parameters)
 * @property int $id
 * @property string $uuid
 * @property string $full_name
 * @property int $addressable_id
 * @property string $addressable_type
 * @property string $address
 * @property int|null $postal_code
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|Order[] $orders
 * @property-read int|null $orders_count
 * @method static Builder|Address whereAddress($value)
 * @method static Builder|Address whereAddressableId($value)
 * @method static Builder|Address whereAddressableType($value)
 * @method static Builder|Address whereCity($value)
 * @method static Builder|Address whereCountry($value)
 * @method static Builder|Address whereCreatedAt($value)
 * @method static Builder|Address whereDeletedAt($value)
 * @method static Builder|Address whereFullName($value)
 * @method static Builder|Address whereId($value)
 * @method static Builder|Address wherePostalCode($value)
 * @method static Builder|Address whereState($value)
 * @method static Builder|Address whereUpdatedAt($value)
 * @method static Builder|Address whereUuid($value)
 */
class Address extends Model
{
    use HasFactory, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'full_name',
        'address',
        'postal_code',
        'city',
        'state',
        'country',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
