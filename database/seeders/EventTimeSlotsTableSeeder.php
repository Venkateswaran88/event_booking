<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventTimeSlot;

class EventTimeSlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventTimeSlot::insert([
            [
                'day_of_week' => 1,
                'event_id' => 1,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 2,
                'event_id' => 1,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 3,
                'event_id' => 1,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 4,
                'event_id' => 1,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 5,
                'event_id' => 1,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 6,
                'event_id' => 1,
                'time_slot_id' => 2,
            ],
            [
                'day_of_week' => 1,
                'event_id' => 2,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 2,
                'event_id' => 2,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 3,
                'event_id' => 2,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 4,
                'event_id' => 2,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 5,
                'event_id' => 2,
                'time_slot_id' => 1,
            ],
            [
                'day_of_week' => 6,
                'event_id' => 2,
                'time_slot_id' => 2,
            ],
        ]);
    }
}
