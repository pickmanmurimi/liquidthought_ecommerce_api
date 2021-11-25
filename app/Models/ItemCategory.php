<?php

namespace App\Models;

use App\Traits\UsesUuid;
use Database\Factories\ItemCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
