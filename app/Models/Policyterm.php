<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policyterm extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_no',
        'customer_id',
        'premium_amount',
        'frequency',
        'due_date',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }
    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_no','id');
    }

   
    // public function policy(): BelongsTo
    // {
    //     return $this->belongsTo(Policy::class, 'policy_no', 'id');
    // }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
