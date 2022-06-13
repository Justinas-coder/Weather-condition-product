<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherConditionResource;
use App\Models\Product;
use App\Models\WeatherCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Http\Resources\OutputResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */

    public function show_products()
    {
        $products = Product::all();

        return $products;
    }

    public function product_recommend(Request $request)
    {
        $weatherValues = Cache::remember('recommendation:'.$request->city , 300, function () use($request) {
            return Http::get('https://api.meteo.lt/v1/places/'.$request->city.'/forecasts/long-term')->json()['forecastTimestamps'];
        });


        $weatherCollection = collect($weatherValues);

        $todayDate = Carbon::now()->startOfDay();

        $endDate = Carbon::now()->addDays(2)->endOfDay();

        $currentTime = Carbon::now('UTC')
            ->format('H:00:00');

        $weatherConditions = $weatherCollection
            ->filter(function ($value, $key) use ($todayDate, $endDate, $currentTime) {

                return $value['forecastTimeUtc'] >= $todayDate &&  $value['forecastTimeUtc'] < $endDate && strpos($value['forecastTimeUtc'], $currentTime);
            })->sortBy('forecastTimeUtc');

            $output = [
                'city' => $request->city,
                'recommendations' => $weatherConditions,
            ];

            return new OutputResource($output);

    }

}
