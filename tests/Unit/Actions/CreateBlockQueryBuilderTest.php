<?php

declare(strict_types=1);

use App\Actions\CreateBlockQueryBuilder;
use App\Models\Block;
use Spatie\QueryBuilder\QueryBuilder;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a query builder from a class', function (): void {
    expect(CreateBlockQueryBuilder::execute(Block::class))->toBeInstanceOf(QueryBuilder::class);
});

it('should create a query builder from an instance', function (): void {
    expect(CreateBlockQueryBuilder::execute(new Block()))->toBeInstanceOf(QueryBuilder::class);
});
