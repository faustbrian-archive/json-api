<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListIncomingTransactionsByWalletController
{
    public function __invoke(TransactionFilterRequest $request, Wallet $wallet): AnonymousResourceCollection
    {
        return TransactionResource::collection(CreateTransactionQueryBuilder::execute($wallet->incomingTransactions())->jsonPaginate());
    }
}
