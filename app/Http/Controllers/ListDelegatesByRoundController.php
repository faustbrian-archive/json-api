<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\RoundResource;
use App\Models\Round;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListDelegatesByRoundController
{
    public function __invoke(int $round): AnonymousResourceCollection
    {
        return RoundResource::collection(Round::where('round', $round)->get());
    }
}
