<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    use HasFactory;
    public function policyPaymentModes()
    {
        return $this->hasMany(PolicyPaymentMode::class, 'payment_mode_id');
    }
}
