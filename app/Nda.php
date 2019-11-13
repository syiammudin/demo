<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nda extends Model
{
  protected $fillable = [ 'user_id', 'buyer', 'seller', 'agent', 'effective_date', 'periode', 'investment', 'attachment', 'status','completion'] ;

  public function VendorManagementHistory(){
      return $this->hasMany('App\VendorManagementHistory', 'vendor_management_id');
  }
  public function User(){
      return $this->belongsTo(User::class)->withTrashed();
  }
}
