<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booking::insert([
            [
                'event_id' => 1,
                'booking_date' => '2022-06-20',
                'start_time' => 28800,
                'first_name' => 'Venkat',
                'last_name' => 'S',
                'email' => 'waran.2050@gmail.com',
            ]
        ]);
    }
}
