<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateBlockQueryBuilder;
use App\Http\Requests\BlockFilterRequest;
use App\Http\Resources\BlockResource;
use App\Models\Block;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ListBlocksController
{
    public function __invoke(BlockFilterRequest $request): AnonymousResourceCollection
    {
        return BlockResource::collection(CreateBlockQueryBuilder::execute(Block::class)->jsonPaginate());
    }
}
