<?php

declare(strict_types=1);

use App\Models\Round;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $round = Round::factory(51)->create()->first();

    $this
        ->get(route('round', [$round->round]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
