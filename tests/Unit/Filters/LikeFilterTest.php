<?php

declare(strict_types=1);

use App\Filters\LikeFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new LikeFilter(),
    new LikeFilter(true),
    new LikeFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
