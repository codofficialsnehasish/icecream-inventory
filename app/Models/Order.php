<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shops::class);
    }
}
