<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Spatie\QueryBuilder\QueryBuilder;

final class CreateTransactionQueryBuilder
{
    /**
     * @param Builder|Relation|string $subject
     */
    public static function execute($subject): QueryBuilder
    {
        return QueryBuilder::for($subject)
            ->allowedFields(['id', 'version', 'block_id', 'sequence', 'timestamp', 'sender_public_key', 'recipient_id', 'type', 'type_group', 'vendor_field', 'amount', 'fee', 'serialized'])
            ->allowedSorts(['id', 'version', 'block_id', 'sequence', 'timestamp', 'sender_public_key', 'recipient_id', 'type', 'type_group', 'vendor_field', 'amount', 'fee', 'serialized'])
            ->allowedFilters([
                ...CreateTextFilters::execute('id'),
                ...CreateRangeFilters::execute('version'),
                ...CreateTextFilters::execute('block_id'),
                ...CreateRangeFilters::execute('sequence'),
                ...CreateRangeFilters::execute('timestamp'),
                ...CreateTextFilters::execute('sender_public_key'),
                ...CreateTextFilters::execute('recipient_id'),
                ...CreateRangeFilters::execute('type'),
                ...CreateRangeFilters::execute('type_group'),
                ...CreateTextFilters::execute('vendor_field'),
                ...CreateRangeFilters::execute('amount'),
                ...CreateRangeFilters::execute('fee'),
                ...CreateTextFilters::execute('serialized'),
            ])
            ->allowedIncludes('block', 'sender', 'recipient');
    }
}
