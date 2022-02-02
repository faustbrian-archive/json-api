<?php

declare(strict_types=1);

use App\Models\Block;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    Block::factory()->create();

    $this
        ->get(route('state.synchronisation'))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
