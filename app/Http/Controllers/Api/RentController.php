<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\RentService;
use App\Models\Car;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function rent(Car $car, RentService $service): JsonResponse
    {
        $user = Auth::user();
        $service->rent($car, $user);
        
        return response()->json('Rented: ' . $car->name);
    }

    public function finishRent(Car $car, RentService $service): JsonResponse
    {
        $user = Auth::user();
        $service->finishRent($car, $user);

        return response()->json('Your rent is over');
    }
}
