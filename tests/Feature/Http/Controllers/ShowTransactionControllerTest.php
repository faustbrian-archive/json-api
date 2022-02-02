<?php

declare(strict_types=1);

use App\Models\Transaction;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $transaction = Transaction::factory()->create();

    $this
        ->get(route('transaction', [$transaction]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
