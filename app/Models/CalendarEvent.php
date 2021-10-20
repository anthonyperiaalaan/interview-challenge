<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CalendarEvent
 *
 * @property int $calendar_event_id
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CalendarEventDay[] $days
 * @method static Builder|CalendarEvent newModelQuery()
 * @method static Builder|CalendarEvent newQuery()
 * @method static Builder|CalendarEvent query()
 * @mixin \Eloquent
 */
class CalendarEvent extends BaseModel
{
    protected $primaryKey = 'calendar_event_id';

    public function days(): HasMany
    {
        return $this->hasMany(CalendarEventDay::class, 'calendar_event_id');
    }
}
