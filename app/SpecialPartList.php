<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialPartList extends Model
{
    protected $fillable = ['request_submittion_id', 'part_name', 'example_part_number', 'vendor_name'];
}
