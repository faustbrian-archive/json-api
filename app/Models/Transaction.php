<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property array|null $asset
 * @property int $amount
 * @property int $fee
 * @property int $timestamp
 * @property int $type
 * @property int $type_group
 * @property string $block_id
 * @property string|null $recipient_id
 * @property string $sender_public_key
 * @property int $block_height
 * @property resource|null $vendor_field
 */
final class Transaction extends Model
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
        'amount'       => 'int',
        'asset'        => 'array',
        'fee'          => 'int',
        'timestamp'    => 'int',
        'type_group'   => 'int',
        'type'         => 'int',
        'block_height' => 'int',
    ];

    /**
     * A transaction belongs to a block.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block(): BelongsTo
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    /**
     * A transaction belongs to a sender.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'sender_public_key', 'public_key');
    }

    /**
     * A transaction belongs to a recipient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'recipient_id', 'address');
    }

    public function getVendorFieldAttribute(): ?string
    {
        return $this->readStream('vendor_field');
    }

    public function getSerializedAttribute(): ?string
    {
        $content = $this->readStream('serialized');

        if (is_null($content)) {
            return null;
        }

        return bin2hex($content);
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
            $builder->orderBy('timestamp', 'desc');
            $builder->orderBy('sequence', 'desc');
        });
    }

    private function readStream(string $attribute): ?string
    {
        $content = $this->attributes[$attribute];

        if (is_null($content)) {
            return null;
        }

        $content = stream_get_contents($content);

        if ($content === '') {
            return null;
        }

        // @codeCoverageIgnoreStart
        if ($content === false) {
            return null;
        }
        // @codeCoverageIgnoreEnd

        return $content;
    }
}
