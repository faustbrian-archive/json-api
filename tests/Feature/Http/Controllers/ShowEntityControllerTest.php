<?php

declare(strict_types=1);

use App\Enums\MagistrateTransactionEntityActionEnum;

use App\Enums\MagistrateTransactionTypeEnum;
use App\Enums\TransactionTypeGroupEnum;
use App\Models\Transaction;
use function Tests\configureDatabase;

beforeEach(fn () => configureDatabase());

it('should respond with a status of 200', function (): void {
    $entity = Transaction::factory()->create([
        'type_group' => TransactionTypeGroupEnum::MAGISTRATE,
        'type'       => MagistrateTransactionTypeEnum::ENTITY,
        'asset'      => [
            'action' => MagistrateTransactionEntityActionEnum::REGISTER,
        ],
    ]);

    $this
        ->get(route('entity', [$entity->id]))
        ->assertOk();
});

// @TODO: tests with allowed and disallowed parameters
