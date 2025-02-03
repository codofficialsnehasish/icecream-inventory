<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // protected $table = "customer";
    protected $primaryKey = "id";

    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'dob',
    //     'gender',
    //     'status'
    // ];
    protected $fillable = ['name', 'phone', 'dob', 'gender', 'status', 'area_id', 'agent_id'];
    // 'area_id'
    public function policies()
    {
        return $this->hasManyThrough(Policyterm::class, Policy::class,'customer_id', 'id');
    }

    // public function policyTerms()
    // {
    //     return $this->hasMany(Policyterm::class);
    // }

    // public function policies()
    // {
    //     return $this->hasManyThrough( PolicyTerm::class);
    // }

    // public function policyPaymentModes()
    // {
    //     return $this->hasMany(PolicyPaymentMode::class);
    // }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }


    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function policyTerms()
    {
        return $this->hasManyThrough(Policyterm::class, Policy::class, 'customer_id', 'policy_no', 'id', 'id');
    }
    public function policyPaymentModes()
    {
        return $this->hasMany(PolicyPaymentMode::class, 'customer_id');
    }
}
