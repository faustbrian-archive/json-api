<?php

declare(strict_types=1);

use App\Models\Round;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    Round::factory(10)->create();

    $this
        ->get(route('rounds'))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
