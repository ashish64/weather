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


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse('This is index',[],200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function lookUp(Request $request): JsonResponse
    {
        $weatherUpdate = $this->weatherApi->makeRequest($request->city);

        $data = [
            'city' => $weatherUpdate['location']['name'],
            'temperature' => $weatherUpdate['current']['temp_c'].' °C',
        ];

        return $this->sendResponse('success',$data,200);
    }

    /**
     * @param string $message
     * @param array $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function sendResponse(string $message, array $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

}
