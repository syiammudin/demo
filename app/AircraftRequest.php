<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AircraftRequest extends Model
{
    protected $fillable = ['request_submittion_id', 'number', 'aircraft_type', 'aircraft_manufacturer','special_work',
                            'maintenance_area','facilities', 'certifying_staff', 'request_number',
                            'approved_data', 'qualified_personel', 'special_tools', 'consumable', 'ability_other_value',
                            'other_main_value','ability','maintenance_area_value','limitation','effective_code','engine',
                            'authority','customer'] ;

    public function RequestSubmittion(){
        return $this->belongsTo(RequestSubmittion::class);
    }

}
