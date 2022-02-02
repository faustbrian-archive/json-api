<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\CreateRangeRules;
use Illuminate\Foundation\Http\FormRequest;

final class WalletFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge(
            [
                'filter.address'                      => ['string', 'size:34'],
                'filter.public_key'                   => ['string', 'size:66'],
                'filter.attributes.second_pubic_key'  => ['string', 'size:66'],
                'filter.attributes.vote'              => ['string', 'size:66'],
                'filter.attributes.delegate.username' => ['string', 'size:34'],
                'filter.attributes.delegate.resigned' => ['boolean'],
            ],
            CreateRangeRules::execute('balance'),
            CreateRangeRules::execute('nonce'),
            CreateRangeRules::execute('attributes.delegate.voteBalance'),
            CreateRangeRules::execute('attributes.delegate.forgedFees'),
            CreateRangeRules::execute('attributes.delegate.forgedRewards'),
            CreateRangeRules::execute('attributes.delegate.producedBlocks'),
            CreateRangeRules::execute('attributes.delegate.rank'),
            CreateRangeRules::execute('attributes.delegate.round'),
        );
    }
}
