<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountData extends Model
{
    use HasFactory;
    protected $table = "bank_account_data";
    protected $primaryKey = "id";
}