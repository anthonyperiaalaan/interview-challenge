<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebApi\CalendarEvent\StoreRequest;
use App\Http\Resources\CalendarEvent as CalendarEventResource;
use App\Models\CalendarEvent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CalendarEventController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreRequest $request): CalendarEventResource
    {
        $event = DB::transaction(
            function () use ($request) {
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
