<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\CalendarEventDay
 *
 * @property int $id
 * @property int $calendar_event_id
 * @property int $day
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|CalendarEventDay newModelQuery()
 * @method static Builder|CalendarEventDay newQuery()
 * @method static Builder|CalendarEventDay query()
 * @mixin \Eloquent
 */
class CalendarEventDay extends BaseModel
{

}
