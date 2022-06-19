<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::insert([
            [
                'name' => 'Men Haircut',
                'duration' => 600,
                'break_duration' => 300,
                'seat_per_slot' => 3,
            ],
            [
                'name' => 'Woman Haircut',
                'duration' => 3600,
                'break_duration' => 600,
                'seat_per_slot' => 3,
            ]
        ]);
    }
}
