<?php

declare(strict_types=1);

use App\Actions\CreateRangeFilters;
use Spatie\QueryBuilder\AllowedFilter;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a set of range filters', function (): void {
    $filters = CreateRangeFilters::execute('height');

    foreach ($filters as $filter) {
        expect($filter)->toBeInstanceOf(AllowedFilter::class);
    }
});
