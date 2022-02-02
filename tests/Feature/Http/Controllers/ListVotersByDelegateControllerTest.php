<?php

declare(strict_types=1);

use App\Models\Wallet;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $wallet = Wallet::factory()->create();

    Wallet::factory(10)->create([
        'attributes' => [
            'vote' => $wallet->public_key,
        ],
    ]);

    $this
        ->get(route('delegate.voters', [$wallet]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
