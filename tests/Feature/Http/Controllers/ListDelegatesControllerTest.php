<?php

declare(strict_types=1);

use App\Models\Wallet;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    Wallet::factory(10)->create();

    $this
        ->get(route('delegates'))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
