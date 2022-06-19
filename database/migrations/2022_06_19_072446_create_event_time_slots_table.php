<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTimeSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_time_slots', function (Blueprint $table) {
            $table->id();
            $table->integer('day_of_week'); // day of week (Sunday - 0, Monday - 1 etc..)
            $table->integer('event_id')->unsignedBigInteger();
            $table->integer('time_slot_id')->unsignedBigInteger();
            // an event should have only one day_of_week
            $table->unique(['day_of_week', 'event_id'], 'event_time_slots_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_time_slots');
    }
}
