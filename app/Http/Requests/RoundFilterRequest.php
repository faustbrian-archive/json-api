<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Actions\CreateRangeRules;
use Illuminate\Foundation\Http\FormRequest;

final class RoundFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return array_merge(
            [
                'filter.public_key' => ['string', 'size:66'],
            ],
            CreateRangeRules::execute('balance'),
            CreateRangeRules::execute('round'),
        );
    }
}
