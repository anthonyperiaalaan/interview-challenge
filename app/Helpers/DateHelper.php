<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function daysOfWeek(): array
    {
        return array_keys(Carbon::getDays());
    }
}
