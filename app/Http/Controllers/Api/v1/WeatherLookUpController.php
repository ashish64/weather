<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\WeatherApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherLookUpController extends Controller
{
    protected object $weatherApi;
    public function __construct( WeatherApi $weatherApi)
    {
        $this->weatherApi = $weatherApi;
    }

    //
    public function index(): JsonResponse
    {
        return $this->sendResponse('This is index',[],200);
    }

    public function lookUp(Request $request)
    {
        $weatherUpdate = $this->weatherApi->makeRequest($request->city);

        $data = [
            'city' => $weatherUpdate['location']['name'],
            'temperature' => $weatherUpdate['current']['temp_c'].' °C',
        ];

        return $this->sendResponse('success',$data,200);
    }

    protected function sendResponse(string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

}
