<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Transaction;

final class ListTransactionFeeAggregatesController
{
    public function __invoke(): array
    {
        return [
            'data' => Transaction::query()
                ->withoutGlobalScope('default-order')
                ->selectRaw('MIN(fee) as min, AVG(fee) as avg, MAX(fee) as max, SUM(fee) as sum, type, type_group')
                ->groupBy('type_group')
                ->groupBy('type')
                ->get(),
        ];
    }
}
