<?php

declare(strict_types=1);

use App\Actions\CreateRangeRules;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a list of rules', function (): void {
    expect(CreateRangeRules::execute('height'))->toBeArray();
});
