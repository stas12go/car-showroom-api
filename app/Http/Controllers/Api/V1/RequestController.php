<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CreditProgram;
use App\Models\CreditRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'carId'          => 'required|integer|exists:cars,id',
            'programId'      => 'required|integer|exists:credit_programs,id',
            'initialPayment' => 'required|integer|min:0',
            'loanTerm'       => 'required|integer|min:1|max:120',
        ], [
            'carId.required'          => 'ID автомобиля обязателен',
            'carId.integer'           => 'ID автомобиля должен быть целым числом',
            'carId.exists'            => 'Автомобиль не найден',
            'programId.required'      => 'ID программы обязателен',
            'programId.integer'       => 'ID программы должен быть целым числом',
            'programId.exists'        => 'Кредитная программа не найдена',
            'initialPayment.required' => 'Первоначальный взнос обязателен',
            'initialPayment.integer'  => 'Первоначальный взнос должен быть целым числом',
            'initialPayment.min'      => 'Первоначальный взнос не может быть отрицательным',
            'loanTerm.required'       => 'Срок кредита обязателен',
            'loanTerm.integer'        => 'Срок кредита должен быть целым числом',
            'loanTerm.min'            => 'Срок кредита должен быть не менее 1 месяца',
            'loanTerm.max'            => 'Срок кредита должен быть не более 120 месяцев',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $car = Car::find($request->carId);
        $program = CreditProgram::find($request->programId);

        if (!$car) {
            return response()->json(['error' => 'Автомобиль не найден'], 404);
        }

        if (!$program) {
            return response()->json(['error' => 'Кредитная программа не найдена'], 404);
        }

        CreditRequest::create([
            'car_id'          => $request->carId,
            'program_id'      => $request->programId,
            'initial_payment' => $request->initialPayment,
            'loan_term'       => $request->loanTerm,
        ]);

        return response()->json(['success' => true]);
    }
}
