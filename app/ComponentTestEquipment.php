<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentTestEquipment extends Model
{
    protected $fillable = ['request_submittion_id', 'part_number', 'part_name', 'available', 'alternate_pn', 'alternate_name', 'remark', 'equivalent', 'attachment'] ;

    function ComponentEquivalent(){
        return $this->hasOne(ComponentEquivalent::class) ;
    }
}
