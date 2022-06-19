<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::insert(
            [
                'name' => 'National Holiday',
                'date' => '2022-06-22',
            ]
        );
    }
}
