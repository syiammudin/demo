<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorManagementHistory extends Model
{
    protected $fillable = ['vendor_management_id', 'status', 'user_id', 'note','data'] ;
    protected $casts = [
        'id' => 'int',
        'data' => 'json',
        ] ;
    protected $appends = [ 'name'];

    public function getNameAttribute()
    {
        return $this->user->name ;
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}
