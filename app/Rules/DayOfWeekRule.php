<?php

namespace App\Rules;

use App\Helpers\DateHelper;
use Illuminate\Contracts\Validation\Rule;

class DayOfWeekRule implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (is_null($value)) {
            return true;
        }

        return in_array($value, DateHelper::daysOfWeek());
    }

    public function message(): string
    {
        return __('validation.day_of_week');
    }
}
