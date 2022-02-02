<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Block;
use Illuminate\Support\Facades\Artisan;
use Spatie\QueryBuilder\Filters\Filter;
use function Spatie\Snapshots\assertMatchesSnapshot;

function configureDatabase(): void
{
    Artisan::call('migrate:fresh', [
        '--database' => 'core',
        '--path'     => 'tests/migrations',
    ]);
}

function assertFilterMatchesQuery(Filter $filter): void
{
    assertMatchesSnapshot($filter(Block::query(), 'Hello', 'id')->toSql());
}
