<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $address
 * @property string|null $public_key
 * @property int $balance
 * @property int $nonce
 * @property array $attributes
 */
final class Wallet extends Model
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'balance'    => 'int',
        'nonce'      => 'int',
        'attributes' => 'array',
    ];

    /**
     * A wallet has many incoming transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'recipient_id', 'address');
    }

    /**
     * A wallet has many outgoing transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outgoingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_public_key', 'public_key');
    }

    /**
     * A wallet has many blocks if it is a delegate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'generator_public_key', 'public_key');
    }

    /**
     * A wallet can have many voters if it is a delegate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function voters(): HasMany
    {
        return $this->hasMany(self::class, 'attributes->vote', 'public_key');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getRouteKeyName()
    {
        return 'address';
    }

    /**
     * Get the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return 'core';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('default-order', function (Builder $builder): void {
            $builder->orderBy('address', 'asc');
        });
    }
}
