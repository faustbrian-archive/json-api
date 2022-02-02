<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateRoundQueryBuilder;
use App\Http\Requests\RoundFilterRequest;
use App\Http\Resources\RoundResource;
use App\Models\Round;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListRoundsController
{
    public function __invoke(RoundFilterRequest $request): AnonymousResourceCollection
    {
        return RoundResource::collection(CreateRoundQueryBuilder::execute(Round::class)->jsonPaginate());
    }
}
