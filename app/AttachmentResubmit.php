<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentResubmit extends Model
{
    protected $fillable = ['request_submittion_id', 'attachment', 'note'] ;
}
