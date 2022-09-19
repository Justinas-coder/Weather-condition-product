<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductRecourse;
use Illuminate\Support\Carbon;
use App\Models\Product;

class RecommendationResource extends JsonResource
{
    public $collects = [];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $products = Product::whereHas('weather_conditions', function ($query) {
            return $query->where('condition', $this['conditionCode']);
        })->take(2)->get();


        return [
            'weather_forecast' => $this['conditionCode'],
            'date' => Carbon::parse($this['forecastTimeUtc'])->toDateString(),
            'products' =>  ProductRecourse::collection($products)

        ];


    }
}
