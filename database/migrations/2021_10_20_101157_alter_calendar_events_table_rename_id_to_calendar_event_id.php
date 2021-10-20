<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCalendarEventsTableRenameIdToCalendarEventId extends Migration
{
    public function up(): void
    {
        Schema::table('calendar_events', function (Blueprint $table) {
            $table->renameColumn('id', 'calendar_event_id');
        });
    }

    public function down()
    {
        Schema::table('calendar_events', function (Blueprint $table) {
            $table->renameColumn('calendar_event_id', 'id');
        });
    }
}
