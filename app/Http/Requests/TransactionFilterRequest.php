<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\CreateRangeRules;
use Illuminate\Foundation\Http\FormRequest;

final class TransactionFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge(
            [
                'filter.id'                => ['string', 'size:64'],
                'filter.block_id'          => ['string', 'size:64'],
                'filter.sender_public_key' => ['string', 'size:66'],
                'filter.recipient_id'      => ['string', 'size:34'],
                'filter.vendor_field'      => ['string', 'min:1', 'max:255'],
            ],
            CreateRangeRules::execute('version'),
            CreateRangeRules::execute('sequence'),
            CreateRangeRules::execute('timestamp'),
            CreateRangeRules::execute('type'),
            CreateRangeRules::execute('type_group'),
            CreateRangeRules::execute('amount'),
            CreateRangeRules::execute('fee'),
        );
    }
}
