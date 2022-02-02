<?php

declare(strict_types=1);

use App\Filters\LessThanOrEqualToFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new LessThanOrEqualToFilter(),
    new LessThanOrEqualToFilter(true),
    new LessThanOrEqualToFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
