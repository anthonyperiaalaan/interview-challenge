<?php

namespace Tests\Feature\CalendarEvent;

use App\Models\CalendarEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CreateCalendarEventTest extends TestCase
{
    public function testCreateCalendarEvent(): void
    {
        $payload = [
            'title' => $this->faker->text,
            'start_date' => $startDate = $this->faker->date('Y-m-d', '-1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate)->format('Y-m-d'),
            'days' => $this->faker->randomElements(array_keys(Carbon::getDays()), 3),
        ];

        $response = $this->postJson('/web-api/calendar-event', $payload)
            ->assertSuccessful()
            ->assertJson(
                [
                    'data' => $payload,
                ]
            );

        $this->assertDatabaseHas(
            'calendar_events',
            Arr::except($payload, 'days')
        );

        foreach ($payload['days'] as $day) {
            $this->assertDatabaseHas(
                'calendar_event_days',
                [
                    'calendar_event_id' => $response->json('data.id'),
                    'day' => $day,
                ]
            );
        }
    }

    public function testDeleteExistingEventsWhenCreatingCalendarEvent(): void
    {
        $existing = CalendarEvent::factory()
            ->create();

        $payload = [
            'title' => $this->faker->text,
            'start_date' => $startDate = $this->faker->date('Y-m-d', '-1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate)->format('Y-m-d'),
            'days' => $this->faker->randomElements(array_keys(Carbon::getDays()), 3),
        ];

        $response = $this->postJson('/web-api/calendar-event?delete-existing=1', $payload)
            ->assertSuccessful()
            ->assertJson(
                [
                    'data' => $payload,
                ]
            );

        $this->assertDatabaseHas(
            'calendar_events',
            Arr::except($payload, 'days')
        );

        $this->assertDeleted($existing);

        foreach ($payload['days'] as $day) {
            $this->assertDatabaseHas(
                'calendar_event_days',
                [
                    'calendar_event_id' => $response->json('data.id'),
                    'day' => $day,
                ]
            );
        }
    }
}
