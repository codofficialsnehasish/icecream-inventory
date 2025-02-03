<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'phone', 'dob', 'gender', 'status', 'area_id'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

   
}
