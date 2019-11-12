<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterRequest extends Model
{

    protected $fillable = ['title','description','picture'];
    public function RequestSubmittion(){
        return $this->belongsTo(RequestSubmittion::class);
    }
}
