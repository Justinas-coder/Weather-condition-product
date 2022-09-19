<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ProductService
{
    public function weatherConditions(Request $request){

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

        return $weatherConditions;
    }



}
