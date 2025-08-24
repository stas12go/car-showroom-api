<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function index(): JsonResponse
    {
        $cars = Car::with('brand')->get()->map(function ($car) {
            return [
                'id'    => $car->id,
                'brand' => [
                    'id'   => $car->brand->id,
                    'name' => $car->brand->name,
                ],
                'photo' => $car->photo,
                'price' => $car->price,
            ];
        });

        return response()->json($cars);
    }

    public function show(int $id): JsonResponse
    {
        $car = Car::with(['brand', 'model'])->find($id);

        if (!$car) {
            return response()->json(['error' => 'Автомобиль не найден'], 404);
        }

        return response()->json([
            'id'    => $car->id,
            'brand' => [
                'id'   => $car->brand->id,
                'name' => $car->brand->name,
            ],
            'model' => [
                'id'   => $car->model->id,
                'name' => $car->model->name,
            ],
            'photo' => $car->photo,
            'price' => $car->price,
        ]);
    }
}
