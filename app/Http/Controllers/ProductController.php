<?php

namespace App\Http\Controllers;

use App\Http\Resources\WeatherConditionResource;
use App\Models\Product;
use App\Models\WeatherCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
        $city = $request->city;

        $response = Http::get('https://api.meteo.lt/v1/places/'.$request->city.'/forecasts/long-term');

        $weatherCollection = collect($response->json()['forecastTimestamps']);

        $todayDate = Carbon::now()->startOfDay();

        $endDate = Carbon::now()->addDays(3)->endOfDay();

        $currentTime = Carbon::now('UTC')
            ->format('H:00:00');

        $weatherBetweenPeriod = $weatherCollection
            ->filter(function ($value, $key) use ($todayDate, $endDate, $currentTime) {

                return $value['forecastTimeUtc'] >= $todayDate &&  $value['forecastTimeUtc'] <= $endDate && strpos($value['forecastTimeUtc'], $currentTime);;
            });


        dd($weatherBetweenPeriod);







        $today_weather_condition = $weather_collection->whereIn('forecastTimeUtc', [$today_date])->first()['conditionCode'];

        $tomorrow_weather_condition = $weather_collection->whereIn('forecastTimeUtc', [$tomorrow_date])->first()['conditionCode'];

        $after_tomorrow_weather_condition = $weather_collection->whereIn('forecastTimeUtc', [$after_tomorrow_date])->first()['conditionCode'];


        $today_weather_condition_id = WeatherCondition::all()->whereIn('condition', [$today_weather_condition])->first()['id'];

        $tomorrow_weather_condition_id = WeatherCondition::all()->whereIn('condition', [$tomorrow_weather_condition])->first()['id'];

        $after_tomorrow_weather_condition_id = WeatherCondition::all()->whereIn('condition', [$after_tomorrow_weather_condition])->first()['id'];


        $queried_products_today = WeatherCondition::with('products')->whereIn('id', [$today_weather_condition_id])->get();

        $queried_products_tomorrow = WeatherCondition::with('products')->whereIn('id', [$tomorrow_weather_condition_id])->get();

        $queried_products_after_tomorrow = WeatherCondition::with('products')->whereIn('id', [$after_tomorrow_weather_condition_id])->get();


        $data = collect([
            $queried_products_today,
            $queried_products_tomorrow,
            $queried_products_after_tomorrow
        ]);

        return WeatherConditionResource::collection($queried_products_today);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
