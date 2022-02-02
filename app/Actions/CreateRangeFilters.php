<?php

declare(strict_types=1);

namespace App\Actions;

use App\Filters\ExactFilter;
use App\Filters\GreaterThanFilter;
use App\Filters\GreaterThanOrEqualToFilter;
use App\Filters\LessThanFilter;
use App\Filters\LessThanOrEqualToFilter;
use Spatie\QueryBuilder\AllowedFilter;

final class CreateRangeFilters
{
    public static function execute(string $property, bool $asJson = false, ?string $query = null): array
    {
        return[
            AllowedFilter::custom($property, new ExactFilter($asJson)),
            AllowedFilter::custom("$property.gt", new GreaterThanFilter($asJson, $query)),
            AllowedFilter::custom("$property.gte", new GreaterThanOrEqualToFilter($asJson, $query)),
            AllowedFilter::custom("$property.lt", new LessThanFilter($asJson, $query)),
            AllowedFilter::custom("$property.lte", new LessThanOrEqualToFilter($asJson, $query)),
        ];
    }
}
