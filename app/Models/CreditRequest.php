<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditRequest extends Model
{
    protected $fillable = ['car_id', 'program_id', 'initial_payment', 'loan_term'];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(CreditProgram::class, 'program_id');
    }
}
