<?php

declare(strict_types=1);

namespace App\Actions;

final class CreateRangeRules
{
    public static function execute(string $property): array
    {
        return[
            "filter.$property"     => ['numeric', 'min:0'],
            "filter.$property.gt"  => ['numeric', 'min:0'],
            "filter.$property.gte" => ['numeric', 'min:0'],
            "filter.$property.lt"  => ['numeric', 'min:0'],
            "filter.$property.lte" => ['numeric', 'min:0'],
        ];
    }
}
