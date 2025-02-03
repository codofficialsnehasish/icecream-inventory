<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'pincode', 'state', 'district', 'police_station', 'landmark'];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function policies()
    {
        return $this->hasManyThrough(Policy::class, Customer::class);
    }
}
