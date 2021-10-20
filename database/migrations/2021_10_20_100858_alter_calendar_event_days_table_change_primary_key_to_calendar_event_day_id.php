<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCalendarEventDaysTableChangePrimaryKeyToCalendarEventDayId extends Migration
{
    public function up(): void
    {
        Schema::table('calendar_event_days', function (Blueprint $table) {
            $table->renameColumn('id', 'calendar_event_day_id');
        });
    }

    public function down(): void
    {
        Schema::table('calendar_event_days', function (Blueprint $table) {
            $table->renameColumn('calendar_event_day_id', 'id');
        });
    }
}
