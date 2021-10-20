<?php

namespace Tests\Feature\CalendarEvent;

use App\Models\CalendarEvent;
use Arr;
use Tests\TestCase;

class ListCalendarEventsTest extends TestCase
{
    public function testListCalendarEvents()
    {
        /** @var \Illuminate\Database\Eloquent\Collection|CalendarEvent[] $events */
        $events = CalendarEvent::factory()
            ->count(3)
            ->withDays()
            ->create();

        $this->getJson('/web-api/calendar-event')
            ->assertSuccessful()
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'calendar_event_id',
                            'title',
                            'start_date',
                            'end_date',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ]
            )
            ->assertJsonCount($events->count(), 'data')
            ->assertJson(
                [
                    'data' => $events->map(
                        function (CalendarEvent $calendarEvent) {
                            return array_merge(
                                Arr::only(
                                    $calendarEvent->toArray(),
                                    [
                                        'calendar_event_id',
                                        'title',
                                        'start_date',
                                        'end_date',
                                        'created_at',
                                        'updated_at',
                                    ]
                                ),
                                [
                                    'days' => $calendarEvent->days->pluck('day')->all(),
                                ]
                            );
                        }
                    )
                        ->toArray(),
                ]
            );
    }
}
