<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\CreditCalculator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditController extends Controller
{
    public function calculate(Request $request, CreditCalculator $calculator): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'price'          => 'required|numeric|min:1',
            'initialPayment' => 'required|numeric|min:0',
            'loanTerm'       => 'required|integer|min:1|max:120',
        ], [
            'price.required'          => 'Цена обязательна',
            'price.numeric'           => 'Цена должна быть числом',
            'price.min'               => 'Цена должна быть положительной',
            'initialPayment.required' => 'Первоначальный взнос обязателен',
            'initialPayment.numeric'  => 'Первоначальный взнос должен быть числом',
            'initialPayment.min'      => 'Первоначальный взнос не может быть отрицательным',
            'loanTerm.required'       => 'Срок кредита обязателен',
            'loanTerm.integer'        => 'Срок кредита должен быть целым числом',
            'loanTerm.min'            => 'Срок кредита должен быть не менее 1 месяца',
            'loanTerm.max'            => 'Срок кредита должен быть не более 120 месяцев',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $result = $calculator->calculateMonthlyPayment((int)$request->price,
                (float)$request->initialPayment,
                (int)$request->loanTerm);

            return response()->json($result);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
