<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentMaterialPlanning extends Model
{
    protected $fillable = ['request_submittion_id', 'part_number', 'part_description', 'qty'] ;
}
