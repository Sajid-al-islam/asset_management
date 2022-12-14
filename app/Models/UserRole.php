<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class,'user_user_role', 'user_role_id','user_id','id','id');
    }
}
