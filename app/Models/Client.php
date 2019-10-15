<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    		'name', 'site', 'state_id', 'city_id', 'region_id', 'attendance_cycle', 'incharge', 'remarks'
    ];
}
