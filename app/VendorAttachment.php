<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorAttachment extends Model
{
    protected $fillable = ['vendor_management_id', 'name_attachment', 'attachment'] ;
}
