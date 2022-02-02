<?php

declare(strict_types=1);

use App\Actions\CreateTransactionQueryBuilder;
use App\Models\Transaction;
use Spatie\QueryBuilder\QueryBuilder;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a query builder from a class', function (): void {
    expect(CreateTransactionQueryBuilder::execute(Transaction::class))->toBeInstanceOf(QueryBuilder::class);
});

it('should create a query builder from an instance', function (): void {
    expect(CreateTransactionQueryBuilder::execute(new Transaction()))->toBeInstanceOf(QueryBuilder::class);
});
