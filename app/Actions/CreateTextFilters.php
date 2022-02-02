<?php

declare(strict_types=1);

namespace App\Actions;

use App\Filters\ExactFilter;
use App\Filters\LikeFilter;
use App\Filters\LikeInsensitiveFilter;
use App\Filters\NotEqualFilter;
use Spatie\QueryBuilder\AllowedFilter;

final class CreateTextFilters
{
    public static function execute(string $property): array
    {
        return[
            AllowedFilter::custom($property, new ExactFilter()),
            AllowedFilter::custom("$property.neq", new NotEqualFilter()),
            AllowedFilter::custom("$property.like", new LikeFilter()),
            AllowedFilter::custom("$property.ilike", new LikeInsensitiveFilter()),
        ];
    }
}
