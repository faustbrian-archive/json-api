<?php

declare(strict_types=1);

use App\Actions\CreateRoundQueryBuilder;
use App\Models\Round;
use Spatie\QueryBuilder\QueryBuilder;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a query builder from a class', function (): void {
    expect(CreateRoundQueryBuilder::execute(Round::class))->toBeInstanceOf(QueryBuilder::class);
});

it('should create a query builder from an instance', function (): void {
    expect(CreateRoundQueryBuilder::execute(new Round()))->toBeInstanceOf(QueryBuilder::class);
});
