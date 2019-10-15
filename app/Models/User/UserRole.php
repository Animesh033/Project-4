<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
        protected $fillable = [
        		'role_id', 'user_id'
        ];
}
