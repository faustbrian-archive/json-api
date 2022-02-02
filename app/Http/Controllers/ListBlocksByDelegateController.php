<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateBlockQueryBuilder;
use App\Http\Requests\BlockFilterRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListBlocksByDelegateController
{
    public function __invoke(BlockFilterRequest $request, Wallet $delegate): AnonymousResourceCollection
    {
        return WalletResource::collection(CreateBlockQueryBuilder::execute($delegate->blocks())->jsonPaginate());
    }
}
