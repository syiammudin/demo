<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalAttachment extends Model
{
    protected $fillable = [ 'request_submittion_id', 'name_attachment'] ;
}
