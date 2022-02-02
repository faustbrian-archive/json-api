<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListVotersByDelegateController
{
    public function __invoke(Wallet $delegate): AnonymousResourceCollection
    {
        return WalletResource::collection(
            $delegate->voters()->orderBy('balance', 'desc')->jsonPaginate()
        );
    }
}
