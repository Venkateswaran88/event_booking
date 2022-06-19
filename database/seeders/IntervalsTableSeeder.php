<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interval;

class IntervalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interval::insert([
            [
                'name' => 'Lunch break',
                'start_time' => 43200,
                'end_time' => 46800,
            ],
            [
                'name' => 'Cleaning break',
                'start_time' => 54000,
                'end_time' => 57600,
            ]
        ]);
    }
}
