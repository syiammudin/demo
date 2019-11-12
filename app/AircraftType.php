<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AircraftType extends Model
{
    use SoftDeletes;

    protected $table = "aircraft_types";
    protected $dates = ['deleted_at'];

    protected $fillable = ['aircraft_type', 'manufacturer','user_id','engine'] ;
}
