<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentSpecialTool extends Model
{
    protected $fillable = ['request_submittion_id', 'part_number', 'part_name', 'available', 'alternate_pn', 'alternate_name', 'remark', 'equivalent', 'attachment'] ;
}
