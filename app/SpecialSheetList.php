<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialSheetList extends Model
{
    protected $fillable = ['request_submittion_id', 'category', 'pd_sheet_number', 'description'] ;
}
