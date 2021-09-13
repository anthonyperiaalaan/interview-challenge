<?php

namespace Database\Factories;

use App\Models\CalendarEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarEventFactory extends Factory
{
    protected $model = CalendarEvent::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->text(),
            'start_date' => $startDate = $this->faker->date('Y-m-d', '-1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate)->format('Y-m-d'),
        ];
    }
}
