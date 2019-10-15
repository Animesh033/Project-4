<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
    		'name','state_id', 'city_id',
    ];

    // public function states()
    // {
    //     return $this->belongsTo('App\Models\State');
    // }

    // public function cities()
    // {
    //     return $this->belongsTo('App\Models\City');
    // }


    /**
        * Get all of the posts that are assigned this tag.
        */
       public function states()
       {
           return $this->morphedByMany('App\Models\State', 'regionable');
       }

       /**
        * Get all of the videos that are assigned this tag.
        */
       public function cities()
       {
           return $this->morphedByMany('App\Models\City', 'regionable');
       }
}
