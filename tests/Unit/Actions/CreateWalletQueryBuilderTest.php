<?php

declare(strict_types=1);

use App\Actions\CreateWalletQueryBuilder;
use App\Models\Wallet;
use Spatie\QueryBuilder\QueryBuilder;

use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should create a query builder from a class', function (): void {
    expect(CreateWalletQueryBuilder::execute(Wallet::class))->toBeInstanceOf(QueryBuilder::class);
});

it('should create a query builder from an instance', function (): void {
    expect(CreateWalletQueryBuilder::execute(new Wallet()))->toBeInstanceOf(QueryBuilder::class);
});
