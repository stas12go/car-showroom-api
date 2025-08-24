<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditProgram extends Model
{
    protected $fillable = [
        'title',
        'interest_rate',
        'min_initial_payment',
        'max_initial_payment',
        'min_loan_term',
        'max_loan_term',
        'min_monthly_payment',
        'max_monthly_payment',
    ];

    public function creditRequests(): HasMany
    {
        return $this->hasMany(CreditRequest::class, 'program_id');
    }
}
