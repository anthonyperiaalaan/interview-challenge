<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\CalendarEvent\StoreRequest;
use App\Http\Resources\CalendarEvent as CalendarEventResource;
use App\Models\CalendarEvent;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CalendarEventController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CalendarEventResource::collection(CalendarEvent::all());
    }

    public function store(StoreRequest $request): CalendarEventResource
    {
        $event = DB::transaction(
            function () use ($request) {
                if ($request->get('delete-existing')) {
                    CalendarEvent::get()
                        ->each(
                            function (CalendarEvent $calendarEvent) {
                                $calendarEvent->delete();
                            }
                        );
                }

                $event = CalendarEvent::create(
                    Arr::only(
                        $request->validated(),
                        [
                            'title',
                            'start_date',
                            'end_date',
                        ]
                    )
                );

                foreach ($request->get('days') as $day) {
                    $event->days()
                        ->create(compact('day'));
                }

                return $event;
            }
        );

        return new CalendarEventResource($event);
    }
}
