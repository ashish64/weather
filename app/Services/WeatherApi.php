<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WeatherApi
{
    protected string $endpoint;

    public function __construct()
    {
        $this->endpoint = 'http://api.weatherapi.com/v1/current.json?key=9538469f34344f8cac6130500242211&q=';
    }

    /**
     * @param string $city
     * @return Response
     */
    public function makeRequest(string $city): \Illuminate\Http\Client\Response
    {
        return Http::get($this->endpoint.$city);
    }
}
