<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceArea extends Model
{
    use SoftDeletes;

    protected $table = "maintenance_areas";
    protected $dates = ['deleted_at'];

    protected $fillable = ['code','description','station','user_id'] ;
}
