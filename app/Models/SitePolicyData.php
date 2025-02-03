<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePolicyData extends Model
{
    use HasFactory;
    protected $table = "site_policy_data";
    protected $primaryKey = "id";
}
