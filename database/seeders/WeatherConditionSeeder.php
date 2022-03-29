<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\WeatherCondition;
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
//
//    {
//        DB::table('weather_conditions')->insert([
//            ['condition' => 'clear'],
//            ['condition' => 'isolated-clouds'],
//            ['condition' => 'scattered-clouds'],
//            ['condition' => 'overcast'],
//            ['condition' => 'light-rain'],
//            ['condition' => 'moderate-rain'],
//            ['condition' => 'heavy-rain'],
//            ['condition' => 'sleet'],
//            ['condition' => 'light-snow'],
//            ['condition' => 'moderate-snow'],
//            ['condition' => 'heavy-snow'],
//            ['condition' => 'fog'],
//            ['condition' => 'no']
//        ]);
//    }

    {
        $data = [
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
        ];

        foreach ($data as $weather_condition) {
            $created_weather_condition = WeatherCondition::create([
                'condition' => $weather_condition['condition']
            ]);

            $product_ids = Product::inRandomOrder()->limit(2)->pluck('id')->toArray();

            $created_weather_condition->products()->sync($product_ids);
        }
    }
}
