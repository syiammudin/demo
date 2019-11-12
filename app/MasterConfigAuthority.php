<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterConfigAuthority extends Model
{
    protected $fillable  = ['master_config_id','rating','value','status', 'status_of_application', 'issue', 'revision'] ;
}
