<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = ['master_request_id','questionare'] ;

    protected $appends = ['name'];
    public function getNameAttribute()
    {
        return $this->MasterRequest['title'] ;
    }

    public function MasterRequest(){
        return $this->belongsTo(MasterRequest::class);
    }
}
