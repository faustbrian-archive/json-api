<?php

declare(strict_types=1);

use App\Filters\LikeInsensitiveFilter;

use function Tests\assertFilterMatchesQuery;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create an SQL query', fn ($filter) => assertFilterMatchesQuery($filter))->with([
    new LikeInsensitiveFilter(),
    new LikeInsensitiveFilter(true),
    new LikeInsensitiveFilter(true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
]);
