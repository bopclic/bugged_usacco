<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;
    public function transactions()
    {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
