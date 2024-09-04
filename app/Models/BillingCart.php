<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingCart extends Model
{
    use HasFactory;
    protected $table = "billing_carts";
    protected $primaryKey = "id";
}
