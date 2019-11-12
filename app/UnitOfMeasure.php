<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitOfMeasure extends Model
{
    use SoftDeletes;

    protected $table = "unit_of_measures";
    protected $dates = ['deleted_at'];

    protected $fillable = ['unit', 'description','user_id'];
}
