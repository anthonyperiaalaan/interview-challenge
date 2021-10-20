<?php

namespace Database\Factories;

use App\Helpers\DateHelper;
use App\Models\CalendarEvent;
use App\Models\CalendarEventDay;
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

    public function withDays(int $count = 3): CalendarEventFactory
    {
        return $this->afterCreating(
            function (CalendarEvent $calendarEvent) use ($count) {
                $days = $this->faker->randomElements(DateHelper::daysOfWeek(), $count);

                foreach ($days as $day) {
                    CalendarEventDay::factory()
                        ->create(
                            [
                                'calendar_event_id' => $calendarEvent->calendar_event_id,
                                'day' => $day,
                            ]
                        );
                }
            }
        );
    }
}
