<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialMaterial extends Model
{
    protected $fillable = ['request_submittion_id', 'part_name', 'part_number', 'remark'] ;
}
