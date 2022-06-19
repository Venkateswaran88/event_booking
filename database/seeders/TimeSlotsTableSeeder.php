<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeSlot;

class TimeSlotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeSlot::insert([
            [
                'start_time' => 28800,
                'end_time' => 72000,
            ],
            [
                'start_time' => 36000,
                'end_time' => 79200,
            ]
        ]);
    }
}
