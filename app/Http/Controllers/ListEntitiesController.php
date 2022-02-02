<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Enums\MagistrateTransactionEntityActionEnum;
use App\Enums\MagistrateTransactionTypeEnum;
use App\Enums\TransactionTypeGroupEnum;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListEntitiesController
{
    public function __invoke(): AnonymousResourceCollection
    {
        $transactions = CreateTransactionQueryBuilder::execute(Transaction::class)
            ->where('type_group', TransactionTypeGroupEnum::MAGISTRATE)
            ->where('type', MagistrateTransactionTypeEnum::ENTITY)
            ->where('asset->action', MagistrateTransactionEntityActionEnum::REGISTER)
            ->orderBy('asset->data->name', 'asc')
            ->jsonPaginate();

        return TransactionResource::collection($transactions);
    }
}
