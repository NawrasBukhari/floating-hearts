<?php

namespace NawrasBukhari\FloatingHearts\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class FloatingHeartsRequest extends Request
{
    public function rules(): array
    {
        return [
            'enabled' => ['sometimes', 'boolean'],
            'hearts_count' => ['nullable', 'integer'],
            'duration' => ['nullable', 'integer'],
        ];
    }
}
