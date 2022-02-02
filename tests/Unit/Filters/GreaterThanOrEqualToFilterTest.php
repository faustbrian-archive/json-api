<?php

declare(strict_types=1);

use App\Filters\GreaterThanOrEqualToFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new GreaterThanOrEqualToFilter(),
    new GreaterThanOrEqualToFilter(true),
    new GreaterThanOrEqualToFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
