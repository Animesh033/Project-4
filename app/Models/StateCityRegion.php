<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StateCityRegion extends Model
{
	protected $fillable = [
			'state_id', 'city_id','region_id',
	];

    // public function states()
    //     {
    //         return $this->hasMany('App\Models\State');
    //     }

        
        // public function cities()
        // {
        //     return $this->hasOne('App\Models\City');
        // }
}
