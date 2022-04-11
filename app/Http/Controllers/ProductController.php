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

        $response = Http::get('https://api.meteo.lt/v1/places/'.$request->city.'/forecasts/long-term');

        $weatherCollection = collect($response->json()['forecastTimestamps']);

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
                'recomendations' => $weatherConditions,
            ];



            return new OutputResource($output);


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
