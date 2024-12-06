<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherLookUpControllerTest extends TestCase
{

    public function test_call_index_endpoint_without_error()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }

    public function test_lookup_can_get_weather_for_a_city()
    {
        // Fake the call
        Http::fake([
            'api.weatherapi.com/v1/current.json?key=9538469f34344f8cac6130500242211&q=copenhagen' => Http::response([
                "location" => [
                    "name" => "Copenhagen",
                    "region" => "Hovedstaden",
                    "country" => "Denmark",
                    "lat" => 55.667,
                    "lon" => 12.583,
                    "tz_id" => "Europe/Copenhagen",
                    "localtime_epoch" => 1733492017,
                    "localtime" => "2024-12-06 14:33"
                ],
                "current" => [
                    "last_updated_epoch" => 1733491800,
                    "last_updated" => "2024-12-06 14:30",
                    "temp_c" => 4,
                    "temp_f" => 39.9,
                    "is_day" => 1,
                    "condition" => [
                        "text" => "Partly cloudy",
                        "icon" => "//cdn.weatherapi.com/weather/64x64/day/116.png",
                        "code" => 1003
                    ],
                    "wind_mph" => 17,
                    "wind_kph" => 27.4,
                    "wind_degree" => 109,
                    "wind_dir" => "ESE",
                    "pressure_mb" => 1004,
                    "pressure_in" => 29.65,
                    "precip_mm" => 0.07,
                    "precip_in" => 0,
                    "humidity" => 93,
                    "cloud" => 75,
                    "feelslike_c" => -0.5,
                    "feelslike_f" => 31.1,
                    "windchill_c" => -0.9,
                    "windchill_f" => 30.5,
                    "heatindex_c" => 4.1,
                    "heatindex_f" => 39.4,
                    "dewpoint_c" => 2.4,
                    "dewpoint_f" => 36.4,
                    "vis_km" => 7,
                    "vis_miles" => 4,
                    "uv" => 0,
                    "gust_mph" => 23.2,
                    "gust_kph" => 37.3
                ]
            ], 200)
        ]);

//        Act
        $response = $this->getJson('/api/look-up?city=copenhagen');

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                "data" =>
                    [
                        "city" => "Copenhagen",
                        "temperature" => "4 °C"
                    ],
                "message" => "success",
                "status" => 200
            ]);
    }
}
