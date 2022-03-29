<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weather_conditions')->insert([
            ['condition' => 'clear'],
            ['condition' => 'isolated-clouds'],
            ['condition' => 'scattered-clouds'],
            ['condition' => 'overcast'],
            ['condition' => 'light-rain'],
            ['condition' => 'moderate-rain'],
            ['condition' => 'heavy-rain'],
            ['condition' => 'sleet'],
            ['condition' => 'light-snow'],
            ['condition' => 'moderate-snow'],
            ['condition' => 'heavy-snow'],
            ['condition' => 'fog'],
            ['condition' => 'no']

        ]);
    }
}
