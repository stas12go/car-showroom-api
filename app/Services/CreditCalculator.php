<?php

namespace App\Services;

use App\Models\CreditProgram;

class CreditCalculator
{
    public function calculateMonthlyPayment(int $price, float $initialPayment, int $loanTerm): array
    {
        $loanAmount = $price - $initialPayment;

        if ($loanAmount <= 0) {
            throw new \InvalidArgumentException('Первоначальный взнос не может быть больше стоимости автомобиля');
        }

        // Получаем все кредитные программы
        $programs = CreditProgram::all();

        foreach ($programs as $program) {
            if ($this->isProgramSuitable($program, $initialPayment, $loanTerm, $loanAmount)) {
                $monthlyPayment = $this->calculatePayment($loanAmount, $program->interest_rate, $loanTerm);

                return [
                    'programId'      => $program->id,
                    'interestRate'   => $program->interest_rate,
                    'monthlyPayment' => (int)round($monthlyPayment),
                    'title'          => $program->title,
                ];
            }
        }

        // Если не найдена подходящая программа, используем первую
        $program = $programs->first();
        $monthlyPayment = $this->calculatePayment($loanAmount, $program->interest_rate, $loanTerm);

        return [
            'programId'      => $program->id,
            'interestRate'   => $program->interest_rate,
            'monthlyPayment' => (int)round($monthlyPayment),
            'title'          => $program->title,
        ];
    }

    private function isProgramSuitable(CreditProgram $program,
        float $initialPayment,
        int $loanTerm,
        float $loanAmount): bool
    {
        // Проверяем первоначальный взнос
        if (
            $program->min_initial_payment !== null && $initialPayment < $program->min_initial_payment
        ) {
            return false;
        }

        if (
            $program->max_initial_payment !== null && $initialPayment > $program->max_initial_payment
        ) {
            return false;
        }

        // Проверяем срок кредита
        if (
            $program->min_loan_term !== null && $loanTerm < $program->min_loan_term
        ) {
            return false;
        }

        if (
            $program->max_loan_term !== null && $loanTerm > $program->max_loan_term
        ) {
            return false;
        }

        // Проверяем ежемесячный платеж (приблизительно)
        $monthlyPayment = $this->calculatePayment($loanAmount, $program->interest_rate, $loanTerm);

        if (
            $program->min_monthly_payment !== null && $monthlyPayment < $program->min_monthly_payment
        ) {
            return false;
        }

        if (
            $program->max_monthly_payment !== null && $monthlyPayment > $program->max_monthly_payment
        ) {
            return false;
        }

        return true;
    }

    private function calculatePayment(float $loanAmount, float $interestRate, int $loanTerm): float
    {
        $monthlyRate = $interestRate / 100 / 12;

        return $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $loanTerm)) / (pow(1 + $monthlyRate, $loanTerm) - 1);
    }
}
