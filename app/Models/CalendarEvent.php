<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CalendarEvent
 *
 * @property int $id
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|CalendarEvent newModelQuery()
 * @method static Builder|CalendarEvent newQuery()
 * @method static Builder|CalendarEvent query()
 * @mixin \Eloquent
 */
class CalendarEvent extends BaseModel
{

}
