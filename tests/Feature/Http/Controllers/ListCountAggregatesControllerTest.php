<?php

declare(strict_types=1);

use App\Models\Block;
use App\Models\Round;
use App\Models\Transaction;
use App\Models\Wallet;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    Block::factory()->create();
    Round::factory()->create();
    Transaction::factory()->create();
    Wallet::factory()->create();

    $this
        ->get(route('statistics.counts'))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
