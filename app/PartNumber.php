<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartNumber extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['part_number', 'ata_chapter', 'part_description','user_id'] ;

    protected $table = "part_numbers";
    protected $dates = ['deleted_at'];

}
