<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineTasklistNumber extends Model
{
    protected $fillable = [ 'request_submittion_id', 'no_group', 'description_tasklist', 'remark_tasklist'] ;
}
