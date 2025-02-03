<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyPaymentMode extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    // Define the relationship with the PaymentMode model
    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class, 'payment_mode_id');
    }
}
