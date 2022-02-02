<?php

declare(strict_types=1);

use App\Models\Transaction;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $entity = Transaction::factory()->create();

    $this
        ->get(route('entity.history', [$entity]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
