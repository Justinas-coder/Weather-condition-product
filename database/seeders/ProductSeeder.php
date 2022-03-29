<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\WeatherCondition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Sun Glasses', 'sku' => 'ML-13', 'price' => '94.76'],
            ['name' => 'Shorts', 'sku' => 'ML-16', 'price' => '9.76'],
            ['name' => 'Baseball Head', 'sku' => 'RL-16', 'price' => '19.76'],
            ['name' => 'Wind Breaker', 'sku' => 'WL-14', 'price' => '191.76'],
            ['name' => 'Jacket', 'sku' => 'JL-16', 'price' => '111.76'],
            ['name' => 'Boots', 'sku' => 'BL-11', 'price' => '133.76'],
            ['name' => 'Rain Coat', 'sku' => 'RL-14', 'price' => '191.76'],
            ['name' => 'Spoked Boots', 'sku' => 'RET-14', 'price' => '191.76'],
            ['name' => 'Synergistic Leather Hat', 'sku' => 'UM-13', 'price' => '91.76'],
            ['name' => 'Pink Hat', 'sku' => 'UM-1', 'price' => '12.76']
        ];

        foreach($data as $product)
        {
            $created_product = Product::create([
                'name' => $product['name'],
                'sku' => $product['sku'],
                'price' => $product['price'],
            ]);

            $weather_ids = WeatherCondition::inRandomOrder()->limit(2)->pluck('id')->toArray();

            $created_product->weather_conditions()->sync($weather_ids);
    }
}
