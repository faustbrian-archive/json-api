<?php

declare(strict_types=1);

use App\Models\Block;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $block = Block::factory()->create();

    $this
        ->get(route('block', [$block]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
