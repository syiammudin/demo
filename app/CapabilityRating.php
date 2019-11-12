<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapabilityRating extends Model
{
    protected $fillable = ['component_capability_list_id','revision', 'name','value',] ;
}
