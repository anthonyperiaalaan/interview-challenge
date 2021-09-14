<?php

namespace Tests\Feature\CalendarEvent;

use App\Models\CalendarEvent;
use Illuminate\Http\Response;
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

    public function testHasRequiredFields()
    {
        $this->postJson('/web-api/calendar-event', [])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertInvalid(
                [
                    'title' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'days' => 'required',
                ]
            );
    }

    public function testTitleMustBeAString()
    {
        $this->postJson('/web-api/calendar-event', ['title' => 1234])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertInvalid(
                [
                    'title' => 'string',
                ]
            );
    }

    public function testTitleHasAMaxCharacterCountOf255()
    {
        $this->postJson('/web-api/calendar-event', ['title' => str_repeat('a', 256)])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertInvalid(
                [
                    'title' => 'must not be greater than 255 characters',
                ]
            );

        $this->postJson('/web-api/calendar-event', ['title' => str_repeat('a', 255)])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertValid('title');
    }

    public function testStartDateAndEndDateMustBeValidDateFormat()
    {
        $payload = [
            'start_date' => 'Jan 1, 2001',
            'end_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];

        $this->postJson('/web-api/calendar-event', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertInvalid(
                [
                    'start_date' => 'does not match the format Y-m-d',
                    'end_date' => 'does not match the format Y-m-d',
                ]
            );
    }
}
