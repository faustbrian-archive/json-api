<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

final class CreateBlockQueryBuilder
{
    /**
     * @param Builder|Relation|string $subject
     */
    public static function execute($subject): QueryBuilder
    {
        return QueryBuilder::for($subject)
            ->allowedFields(['id', 'version', 'timestamp', 'previous_block', 'height', 'number_of_transactions', 'total_amount', 'total_fee', 'reward', 'payload_length', 'payload_hash', 'generator_public_key', 'block_signature'])
            ->allowedSorts(['id', 'version', 'timestamp', 'previous_block', 'height', 'number_of_transactions', 'total_amount', 'total_fee', 'reward', 'payload_length', 'payload_hash', 'generator_public_key', 'block_signature'])
            ->allowedFilters([
                ...CreateTextFilters::execute('id'),
                ...CreateRangeFilters::execute('version'),
                ...CreateRangeFilters::execute('timestamp'),
                ...CreateTextFilters::execute('previous_block'),
                ...CreateRangeFilters::execute('height'),
                ...CreateRangeFilters::execute('number_of_transactions'),
                ...CreateRangeFilters::execute('total_amount'),
                ...CreateRangeFilters::execute('total_fee'),
                ...CreateRangeFilters::execute('reward'),
                ...CreateRangeFilters::execute('payload_length'),
                ...CreateTextFilters::execute('payload_hash'),
                ...CreateTextFilters::execute('generator_public_key'),
                ...CreateTextFilters::execute('block_signature'),
            ])
            ->allowedIncludes('transactions', 'delegate', 'previous');
    }
}
