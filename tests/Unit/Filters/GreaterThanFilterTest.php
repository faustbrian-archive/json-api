<?php

declare(strict_types=1);

use App\Filters\GreaterThanFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new GreaterThanFilter(),
    new GreaterThanFilter(true),
    new GreaterThanFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
