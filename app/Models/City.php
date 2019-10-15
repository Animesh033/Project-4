<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
    		'name', 'state_id',
    ];

    // public function region()
    // {
    //     return $this->hasOne('App\Models\Region');
    // }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function regions()
        {
            return $this->morphToMany('App\Models\Region', 'regionable');
        }
}
