<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateWalletQueryBuilder;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListDelegatesController
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $query = Wallet::whereNotNull('attributes->delegate')->orderBy('attributes->delegate->rank', 'asc');

        return WalletResource::collection(CreateWalletQueryBuilder::execute($query)->jsonPaginate());
    }
}
