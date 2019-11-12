<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftMaterial extends Model
{
    protected $fillable = [ 'request_submittion_id', 'description_material', 'pn', 'availability',
                             'camp_number', 'jobcard_number', 'title', 'mpd_number', 'references', 'interval', 'qty'] ;
}
