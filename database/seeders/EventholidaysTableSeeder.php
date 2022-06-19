<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventHoliday;

class EventholidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventHoliday::insert([
            [
                'event_id' => 1,
                'holiday_id' => 1,
            ],
            [
                'event_id' => 2,
                'holiday_id' => 1
            ]
        ]);
    }
}
