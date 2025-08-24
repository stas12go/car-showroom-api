<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credit_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('interest_rate', 2);
            $table->integer('min_initial_payment')->nullable();
            $table->integer('max_initial_payment')->nullable();
            $table->integer('min_loan_term')->nullable();
            $table->integer('max_loan_term')->nullable();
            $table->integer('min_monthly_payment')->nullable();
            $table->integer('max_monthly_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_programs');
    }
};
