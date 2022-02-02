<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\BlockResource;
use App\Models\Block;
use App\Models\Wallet;

final class ShowSynchronisationStateController
{
    public function __invoke(): array
    {
        return [
            'data' => [
                'block'  => BlockResource::make(Block::first()),
                'supply' => Wallet::where('balance', '>', 0)->sum('balance'),
            ],
        ];
    }
}
