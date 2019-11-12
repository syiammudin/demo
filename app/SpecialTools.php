<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialTools extends Model
{
    protected $fillable = ['request_submittion_id', 'part_name', 'tool_name', 'qty', 'availability'] ;
}
