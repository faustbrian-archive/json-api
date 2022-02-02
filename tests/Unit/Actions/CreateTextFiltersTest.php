<?php

declare(strict_types=1);

use App\Actions\CreateTextFilters;
use Spatie\QueryBuilder\AllowedFilter;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a set of text filters', function (): void {
    $filters = CreateTextFilters::execute('id');

    foreach ($filters as $filter) {
        expect($filter)->toBeInstanceOf(AllowedFilter::class);
    }
});
