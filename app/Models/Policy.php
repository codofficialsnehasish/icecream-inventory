<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;
    protected $fillable = [
        'policy_type', 'policy_no', 'sum_assured', 'policy_term', 'maturity_date',
        'nominee_name', 'nominee_relationship', 'nominee_contact_number'
    ];

     // public function policyTerm()
    // {
    //     return $this->belongsTo(Policyterm::class);
    // }
    // public function policyTerms()
    // {
    //     return $this->hasMany(Policyterm::class, 'policy_no', 'id');
    // }

    // public function frequancyPolicy()
    // {
    //     return $this->belongsTo(FrequancyPolicy::class, 'type_id');
    // }

    public function policyterms()
    {
        return $this->hasMany(Policyterm::class, 'policy_no', 'id');
    }

    public function policyPaymentModes()
    {
        return $this->hasMany(PolicyPaymentMode::class, 'policy_no', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // public function policyTerms()
    // {
    //     return $this->hasMany(PolicyTerm::class, 'policy_no');
    // }


    // public function remainingTerm()
    // {
    //     $endDate = Carbon::parse($this->maturity_date);
    //     $now = Carbon::now();
    //     return $endDate->diffInYears($now);
    // }

    // public function remainingTerm()
    // {
    //     $endDate = Carbon::parse($this->maturity_date);
    //     $now = Carbon::now();
    //     return $endDate->diffInYears($now);
    // }
    // public function Policyterm(): HasMany
    // {
    //     return $this->hasMany(Policyterm::class, 'policy_no', 'id');
    // }

}
