<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListTransactionsByWalletController
{
    public function __invoke(TransactionFilterRequest $request, Wallet $wallet): AnonymousResourceCollection
    {
        $query = CreateTransactionQueryBuilder::execute(Transaction::class);
        $query->where(fn ($query): Builder   => $query->where('sender_public_key', $wallet->public_key));
        $query->orWhere(fn ($query): Builder => $query->where('recipient_id', $wallet->address));
        $query->orWhere(fn ($query): Builder => $query->whereJsonContains('asset->payments', [['recipientId' => $wallet->address]]));

        return TransactionResource::collection($query->jsonPaginate());
    }
}
