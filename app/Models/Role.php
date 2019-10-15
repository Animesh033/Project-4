<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
    		'name',
    ];

    public function admins(){
		return $this->BelongsToMany('App\Models\Admin\Admin', 'admin_roles');
    }

    public function users(){
		return $this->BelongsToMany('App\Models\User\User', 'user_roles');
    }
}
