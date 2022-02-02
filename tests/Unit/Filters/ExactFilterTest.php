<?php

declare(strict_types=1);

use App\Filters\ExactFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new ExactFilter(),
    new ExactFilter(true),
    new ExactFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
