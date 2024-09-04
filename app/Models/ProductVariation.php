<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'value', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
