<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Salesman extends Authenticatable
{
    use HasApiTokens, HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
