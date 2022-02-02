<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowTransactionController
{
    public function __invoke(string $id): JsonResource
    {
        return TransactionResource::make(CreateTransactionQueryBuilder::execute(Transaction::class)->findOrFail($id));
    }
}
