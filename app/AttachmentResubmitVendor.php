<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachmentResubmitVendor extends Model
{
    protected $fillable = ['vendor_management_id', 'attachment', 'note'] ;
}
