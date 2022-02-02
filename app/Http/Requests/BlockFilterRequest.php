<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\CreateRangeRules;
use Illuminate\Foundation\Http\FormRequest;

final class BlockFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge(
            [
                'filter.id'                   => ['string', 'size:64'],
                'filter.previous_block'       => ['string', 'size:255'],
                'filter.payload_hash'         => ['string', 'size:64'],
                'filter.generator_public_key' => ['string', 'size:66'],
                'filter.block_signature'      => ['string', 'size:140'],
            ],
            CreateRangeRules::execute('version'),
            CreateRangeRules::execute('timestamp'),
            CreateRangeRules::execute('height'),
            CreateRangeRules::execute('number_of_transactions'),
            CreateRangeRules::execute('total_amount'),
            CreateRangeRules::execute('total_fee'),
            CreateRangeRules::execute('reward'),
            CreateRangeRules::execute('payload_length'),
        );
    }
}
