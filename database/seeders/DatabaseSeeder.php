<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EventTableSeeder::class);
        $this->call(HolidaysTableSeeder::class);
        $this->call(IntervalsTableSeeder::class);
        $this->call(TimeSlotsTableSeeder::class);
        $this->call(EventholidaysTableSeeder::class);
        $this->call(EventIntervalsTableSeeder::class);
        $this->call(EventTimeSlotsTableSeeder::class);
        $this->call(BookingsTableSeeder::class);
    }
}
