<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventDaysTable extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_event_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calendar_event_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedTinyInteger('day');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_event_days');
    }
}
