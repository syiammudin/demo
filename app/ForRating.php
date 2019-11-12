<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForRating extends Model
{
    use SoftDeletes;

    protected $table = "for_ratings";
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_of_rating','desciption','form_type'] ;
}
