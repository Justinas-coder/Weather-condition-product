<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
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
        return Product::all();
    }

    public function product_recommend(Request $request, ProductService $service)
    {
            $output = [
                'city' => $request->city,
                'recommendations' => $service->weatherConditions($request),
            ];

            return new OutputResource($output);

    }

}
