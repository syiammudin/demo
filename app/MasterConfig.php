<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterConfig extends Model
{
    protected $fillable = ['maintenance_area_value','request_type', 'aircraft_type', 'maintenance_area', 'ability','authority',
                            'request_number','request_submittion_id','engine_name','part_number','data','master_request_id','component_type',
                            'customer','aircraft_rating','date_approve'] ;

    protected $casts = [
       'id' => 'int',
       'data' => 'json'
    ];

    function MasterConfigAuthority(){
        return $this->hasMany(MasterConfigAuthority::class) ;
    }

}
