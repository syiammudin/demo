<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentManhoursPlanning extends Model
{
    protected $fillable = ['request_submittion_id', 'task_name', 'man_hour', 'man_power'] ;
}
