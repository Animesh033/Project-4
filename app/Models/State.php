<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
    		'name',
    ];
    // public function regions()
    //     {
    //         return $this->hasManyThrough('App\Models\Region', 'App\Models\City');
    //     }

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function regions()
        {
            return $this->morphToMany('App\Models\Region', 'regionable');
        }
}
