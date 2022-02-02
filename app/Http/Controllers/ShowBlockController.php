<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateBlockQueryBuilder;
use App\Http\Resources\BlockResource;
use App\Models\Block;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowBlockController
{
    public function __invoke(string $id): JsonResource
    {
        return BlockResource::make(CreateBlockQueryBuilder::execute(Block::class)->findOrFail($id));
    }
}
