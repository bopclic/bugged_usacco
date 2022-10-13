<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => (Carbon::today() < $attributes['maturity_date'] && $attributes['loan_balance'] === 0)
                ? $value : "defaulted"
        );
    }
}
