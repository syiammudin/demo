<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineVendorList extends Model
{
    protected $fillable = ['request_submittion_id', 'ata', 'part_name', 'vendor', 'remark_vendorlist'] ;
}
