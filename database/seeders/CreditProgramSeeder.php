<?php

namespace Database\Seeders;

use App\Models\CreditProgram;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreditProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CreditProgram::create([
            'title'               => 'First Program',
            'interest_rate'       => 12.3,
            'min_initial_payment' => 200000,
            'max_initial_payment' => 1000000,
            'min_loan_term'       => 12,
            'max_loan_term'       => 60,
            'min_monthly_payment' => 10000,
            'max_monthly_payment' => 50000,
        ]);

        CreditProgram::create([
            'title'               => 'Second Program',
            'interest_rate'       => 15.5,
            'min_initial_payment' => 100000,
            'max_initial_payment' => 800000,
            'min_loan_term'       => 12,
            'max_loan_term'       => 84,
            'min_monthly_payment' => 8000,
            'max_monthly_payment' => 40000,
        ]);

        CreditProgram::create([
            'title'               => 'Third Program',
            'interest_rate'       => 9.8,
            'min_initial_payment' => 500000,
            'max_initial_payment' => 2000000,
            'min_loan_term'       => 24,
            'max_loan_term'       => 72,
            'min_monthly_payment' => 15000,
            'max_monthly_payment' => 80000,
        ]);
    }
}
