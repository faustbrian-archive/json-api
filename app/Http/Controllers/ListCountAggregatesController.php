<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\MagistrateTransactionEntityActionEnum;
use App\Enums\MagistrateTransactionTypeEnum;
use App\Enums\TransactionTypeGroupEnum;
use App\Models\Block;
use App\Models\Round;
use App\Models\Transaction;
use App\Models\Wallet;

final class ListCountAggregatesController
{
    public function __invoke(): array
    {
        return [
            'data' => [
                'blocks'       => Block::count(),
                'delegates'    => Wallet::whereNotNull('attributes->delegate')->count(),
                'entities'     => Transaction::query()
                    ->where('type_group', TransactionTypeGroupEnum::MAGISTRATE)
                    ->where('type', MagistrateTransactionTypeEnum::ENTITY)
                    ->where('asset->action', MagistrateTransactionEntityActionEnum::REGISTER)
                    ->count(),
                'rounds'       => Round::count(),
                'transactions' => Transaction::count(),
                'wallets'      => Wallet::count(),
            ],
        ];
    }
}
