<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventInterval;

class EventIntervalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventInterval::insert([
            [
                'event_id' => 1,
                'interval_id' => 1,
            ],
            [
                'event_id' => 1,
                'interval_id' => 2,
            ],
            [
                'event_id' => 2,
                'interval_id' => 1,
            ],
            [
                'event_id' => 2,
                'interval_id' => 2,
            ]
        ]);
    }
}
