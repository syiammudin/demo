<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapabilityList extends Model
{
    protected $fillable = [ 'type_capability_list', 'revision', 'user_id','type_supplier','authority','form_type','issue'] ;

    public function User(){
        return $this->belongsTo(User::class);
    }

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->User->name ;
    }

    public function VendorCapablityListDetail(){
        return $this->hasMany(VendorCapablityListDetail::class);
    }

    public function ComponentCapabilityList(){
        return $this->hasMany(ComponentCapabilityList::class);
    }

}
