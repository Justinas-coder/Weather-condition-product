<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_respond($city = 'vilnius')
    {
        $response = $this->getJson('/api/products/recommendation/kaunas');

        $response->assertJsonStructure([
        'data' => [
            'city',
            'recommendations' => [
                '*' => [
                    'weather_forecast',
                    'date',
                    'products' => [
                        '*' => [
                            'sku',
                            'name',
                            'price'
                        ]
                    ]
                ]
            ]

        ]
]);


        $response->assertStatus(200);
    }
}
