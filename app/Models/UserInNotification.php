<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInNotification extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "user_in_notification";
}
