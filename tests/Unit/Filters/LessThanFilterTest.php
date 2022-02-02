<?php

declare(strict_types=1);

use App\Filters\LessThanFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new LessThanFilter(),
    new LessThanFilter(true),
    new LessThanFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
