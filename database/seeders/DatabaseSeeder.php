<?php

namespace Database\Seeders;

use App\Models\WeatherCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            ProductSeeder::class,
            WeatherConditionSeeder::class,
            UserSeeder::class
        ]);
    }
}
