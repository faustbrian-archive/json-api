<?php

declare(strict_types=1);

use App\Filters\NotEqualFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new NotEqualFilter(),
    new NotEqualFilter(true),
    new NotEqualFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
