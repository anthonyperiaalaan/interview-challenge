<?php

namespace App\Http\Requests\WebApi\CalendarEvent;

use App\Rules\DayOfWeekRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'start_date' => [
                'required',
                'date_format:Y-m-d',
            ],
            'end_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:start_date',
            ],
            'days' => [
                'required',
                'array',
                'min:1',
            ],
            'days.*' => [
                'required',
                'integer',
                new DayOfWeekRule(),
            ],
        ];
    }
}
