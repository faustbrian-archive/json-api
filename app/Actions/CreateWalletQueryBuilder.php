<?php

declare(strict_types=1);

namespace App\Actions;

use App\Filters\ExactFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

final class CreateWalletQueryBuilder
{
    /**
     * @param Builder|Relation|string $subject
     */
    public static function execute($subject): QueryBuilder
    {
        return QueryBuilder::for($subject)
            ->allowedFields(['address', 'public_key', 'balance', 'nonce', 'attributes'])
            ->allowedSorts(['address', 'public_key', 'balance', 'nonce'])
            ->allowedFilters([
                ...CreateTextFilters::execute('address'),
                ...CreateTextFilters::execute('public_key'),
                ...CreateRangeFilters::execute('balance'),
                ...CreateRangeFilters::execute('nonce'),
                ...CreateTextFilters::execute('attributes.second_pubic_key'),
                ...CreateTextFilters::execute('attributes.vote'),
                ...CreateTextFilters::execute('attributes.delegate.username'),
                ...CreateRangeFilters::execute('attributes.delegate.voteBalance', true, '("attributes"->\'delegate\'->>\'voteBalance\')::int'),
                ...CreateRangeFilters::execute('attributes.delegate.forgedFees', true, '("attributes"->\'delegate\'->>\'forgedFees\')::int'),
                ...CreateRangeFilters::execute('attributes.delegate.forgedRewards', true, '("attributes"->\'delegate\'->>\'forgedRewards\')::int'),
                ...CreateRangeFilters::execute('attributes.delegate.producedBlocks', true, '("attributes"->\'delegate\'->>\'producedBlocks\')::int'),
                ...CreateRangeFilters::execute('attributes.delegate.rank', true, '("attributes"->\'delegate\'->>\'rank\')::int'),
                ...CreateRangeFilters::execute('attributes.delegate.round', true, '("attributes"->\'delegate\'->>\'round\')::int'),
                AllowedFilter::custom('attributes.delegate.resigned', new ExactFilter(true)),
            ]);
    }
}
