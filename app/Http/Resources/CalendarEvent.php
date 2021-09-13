<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarEvent extends JsonResource
{
    /**
     * @var \App\Models\CalendarEvent
     */
    public $resource;

    public function toArray($request): array
    {
        return array_merge(
            $this->resource->only('id', 'title', 'start_date', 'end_date', 'created_at', 'updated_at'),
            [
                'days' => $this->resource->days->pluck('day')->all(),
            ]
        );
    }
}
