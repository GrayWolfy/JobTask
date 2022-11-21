<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\JsonResponse;

final class CarController extends Controller
{
    public function index(CarRepository $repository): JsonResponse
    {
        return response()->json(new CarCollection(Car::notRented($repository)));
    }

    public function show(Car $car): JsonResponse
    {
        return response()->json(new CarResource($car));
    }
}
