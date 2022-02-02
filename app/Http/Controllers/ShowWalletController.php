<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateWalletQueryBuilder;
use App\Http\Resources\WalletResource;
use App\Models\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowWalletController
{
    public function __invoke(string $address): JsonResource
    {
        return WalletResource::make(CreateWalletQueryBuilder::execute(Wallet::class)->where('address', $address)->firstOrFail());
    }
}
