<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

/**
 * App\Models\VerificationToken
 *
 * @property-read User $user
 * @method static Builder|VerificationToken newModelQuery()
 * @method static Builder|VerificationToken newQuery()
 * @method static Builder|VerificationToken query()
 * @mixin Eloquent
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $token
 * @property Carbon $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|VerificationToken whereCreatedAt($value)
 * @method static Builder|VerificationToken whereExpiresAt($value)
 * @method static Builder|VerificationToken whereId($value)
 * @method static Builder|VerificationToken whereToken($value)
 * @method static Builder|VerificationToken whereUpdatedAt($value)
 * @method static Builder|VerificationToken whereUserId($value)
 * @method static Builder|VerificationToken whereUuid($value)
 */
class VerificationToken extends Model
{
    use HasFactory, UsesUuid;

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'token',
        'expires_at'
    ];

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'expires_at' => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
