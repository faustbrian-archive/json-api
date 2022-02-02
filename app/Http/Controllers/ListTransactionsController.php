<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListTransactionsController
{
    public function __invoke(TransactionFilterRequest $request): AnonymousResourceCollection
    {
        return TransactionResource::collection(CreateTransactionQueryBuilder::execute(Transaction::class)->jsonPaginate());
    }
}
