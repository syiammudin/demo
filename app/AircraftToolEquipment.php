<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftToolEquipment extends Model
{
    protected $fillable = ['request_submittion_id', 'description_tools', 'part_no', 'qty', 'unit', 'remark','location',
                            'camp_number', 'jobcard_number', 'title', 'mpd_number', 'references', 'interval'] ;

    protected $casts = [
        'id' => 'int',
        'related_maintenance' => 'json',
        'alternate' => 'json',
        'recomended' => 'json',
        'maintenance_task' => 'json',
        'alternate_tool' => 'json',
        'recomended_tool' => 'json',
    ] ;
}
