<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestHistory extends Model
{
    protected $fillable = ['request_submittion_id', 'status', 'user_id', 'note','data'];
    protected $casts = [
        'id' => 'int',
        'data' => 'json',
    ] ;

    protected $appends = [ 'signature', 'name'];

    public function getSignatureAttribute()
    {
        return $this->user->signature ;
    }

    public function getNameAttribute()
    {
        return $this->user->name ;
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id', 'id' )->withTrashed();
    }
}
