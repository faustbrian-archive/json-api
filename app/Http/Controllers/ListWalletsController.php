<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateWalletQueryBuilder;
use App\Http\Requests\WalletFilterRequest;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListWalletsController
{
    public function __invoke(WalletFilterRequest $request): AnonymousResourceCollection
    {
        return WalletResource::collection(CreateWalletQueryBuilder::execute(Wallet::class)->jsonPaginate());
    }
}
