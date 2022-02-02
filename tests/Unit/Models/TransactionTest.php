<?php

declare(strict_types=1);

use App\Models\Block;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use function Tests\configureDatabase;

beforeEach(function () {
    configureDatabase();

    $this->subject = Transaction::factory()->create([
        'fee'    => '100000000',
        'amount' => '200000000',
    ]);
});

it('should belong to a block', function () {
    expect($this->subject->block())->toBeInstanceOf(BelongsTo::class);
    expect($this->subject->block)->toBeInstanceOf(Block::class);
});

it('should belong to a sender', function () {
    Wallet::factory()->create(['public_key' => $this->subject->sender_public_key]);

    expect($this->subject->sender())->toBeInstanceOf(BelongsTo::class);
    expect($this->subject->sender)->toBeInstanceOf(Wallet::class);
});

it('should belong to a recipient', function () {
    Wallet::factory()->create(['address' => $this->subject->recipient_id]);

    expect($this->subject->recipient())->toBeInstanceOf(BelongsTo::class);
    expect($this->subject->recipient)->toBeInstanceOf(Wallet::class);
});

it('should get the vendor field', function () {
    $transaction = Transaction::factory()->create();

    DB::connection('core')->update('UPDATE transactions SET vendor_field = ? WHERE id = ?', ['Hello World', $transaction->id]);

    $transaction->refresh();

    expect($transaction->vendor_field)->toBe('Hello World');
});

it('should fail to get the vendor field if it is empty', function () {
    $transaction = Transaction::factory()->create(['vendor_field' => null]);

    expect($transaction->vendor_field)->toBeNull();
});

it('should fail to get the vendor field if it is empty after reading it', function () {
    $transaction = Transaction::factory()->create();

    DB::connection('core')->update('UPDATE transactions SET vendor_field = ? WHERE id = ?', ['', $transaction->id]);

    $transaction->refresh();

    expect($transaction->vendor_field)->toBeNull();
});

it('should get the serialized', function () {
    $transaction = Transaction::factory()->create();

    DB::connection('core')->update('UPDATE transactions SET serialized = ? WHERE id = ?', ['Hello World', $transaction->id]);

    $transaction->refresh();

    expect($transaction->serialized)->toBe('48656c6c6f20576f726c64');
});

it('should fail to get the serialized if it is empty', function () {
    $transaction = Transaction::factory()->create(['serialized' => null]);

    expect($transaction->serialized)->toBeNull();
});

it('should fail to get the serialized if it is empty after reading it', function () {
    $transaction = Transaction::factory()->create();

    DB::connection('core')->update('UPDATE transactions SET serialized = ? WHERE id = ?', ['', $transaction->id]);

    $transaction->refresh();

    expect($transaction->serialized)->toBeNull();
});
