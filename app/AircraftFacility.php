<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftFacility extends Model
{
    protected $fillable = [ 'request_submittion_id','description_main','description', 'quantity', 'unit', 'status', 'remark'] ;

    public function MasterFacility(){
        return $this->belongsTo(MasterFacility::class);
    }
}
