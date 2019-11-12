<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineConsumableMaterial extends Model
{
    protected $fillable = ['request_submittion_id', 'part_number', 'description_material','remark','qty'] ;
}
