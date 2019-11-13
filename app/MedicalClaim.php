<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MedicalClaim extends Model
{
    protected $fillable = ['user_id', 'keterangan', 'attachment', 'status','completion'] ;

    public function RequestHistory(){
        return $this->hasMany('App\RequestHistory', 'request_submittion_id');
    }
    public function User(){
        return $this->belongsTo(User::class)->withTrashed();
    }
}
