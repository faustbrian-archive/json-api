<?php

declare(strict_types=1);

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use function Tests\configureDatabase;

beforeEach(function () {
    configureDatabase();

    $this->subject = Wallet::factory()->create([
        'balance'    => '100000000000',
        'attributes' => [
            'delegate' => [
                'voteBalance' => '200000000000',
            ],
        ],
    ]);
});

it('should have many incoming transactions', function () {
    expect($this->subject->incomingTransactions())->toBeInstanceOf(HasMany::class);
    expect($this->subject->incomingTransactions)->toBeInstanceOf(Collection::class);
});

it('should have many outgoing transactions', function () {
    expect($this->subject->outgoingTransactions())->toBeInstanceOf(HasMany::class);
    expect($this->subject->outgoingTransactions)->toBeInstanceOf(Collection::class);
});

it('should have many blocks', function () {
    expect($this->subject->blocks())->toBeInstanceOf(HasMany::class);
    expect($this->subject->blocks)->toBeInstanceOf(Collection::class);
});

it('should have many voters', function () {
    expect($this->subject->voters())->toBeInstanceOf(HasMany::class);
    expect($this->subject->voters)->toBeInstanceOf(Collection::class);
});
