<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Enums\MagistrateTransactionEntityActionEnum;
use App\Enums\MagistrateTransactionTypeEnum;
use App\Enums\TransactionTypeGroupEnum;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowEntityController
{
    public function __invoke(string $id): JsonResource
    {
        $transaction = CreateTransactionQueryBuilder::execute(Transaction::class)
            ->where('type_group', TransactionTypeGroupEnum::MAGISTRATE)
            ->where('type', MagistrateTransactionTypeEnum::ENTITY)
            ->where('asset->action', MagistrateTransactionEntityActionEnum::REGISTER)
            ->findOrFail($id);

        return TransactionResource::make($transaction);
    }
}
