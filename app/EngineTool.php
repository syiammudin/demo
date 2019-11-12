<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineTool extends Model
{
    protected $fillable = ['request_submittion_id', 'special_tool', 'base_pn', 'tool_desciption', 'task', 'est_arrival'] ;
}
