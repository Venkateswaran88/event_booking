<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->date('booking_date');
            $table->integer('start_time');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->timestamps();
            $table->unique(['event_id', 'booking_date', 'start_time', 'email'], 'booking_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
