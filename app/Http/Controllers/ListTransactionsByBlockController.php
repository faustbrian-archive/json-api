<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateTransactionQueryBuilder;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Block;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListTransactionsByBlockController
{
    public function __invoke(TransactionFilterRequest $request, Block $block): AnonymousResourceCollection
    {
        return TransactionResource::collection(CreateTransactionQueryBuilder::execute($block->transactions())->jsonPaginate());
    }
}
