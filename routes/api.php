<?php

use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\CreditController;
use App\Http\Controllers\Api\V1\RequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Список автомобилей
    Route::get('/cars', [CarController::class, 'index']);

    // Детальная информация об автомобиле
    Route::get('/cars/{id}', [CarController::class, 'show']);

    // Расчет кредита
    Route::get('/credit/calculate', [CreditController::class, 'calculate']);

    // Создание заявки
    Route::post('/request', [RequestController::class, 'store']);
});
