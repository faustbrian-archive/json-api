<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

final class CreateRoundQueryBuilder
{
    /**
     * @param Builder|Relation|string $subject
     */
    public static function execute($subject): QueryBuilder
    {
        return QueryBuilder::for($subject)
            ->allowedFields(['public_key', 'balance', 'round'])
            ->allowedSorts(['public_key', 'balance', 'round'])
            ->allowedFilters([
                ...CreateTextFilters::execute('public_key'),
                ...CreateRangeFilters::execute('balance'),
                ...CreateRangeFilters::execute('round'),
            ]);
    }
}
