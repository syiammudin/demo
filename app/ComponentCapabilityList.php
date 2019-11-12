<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentCapabilityList extends Model
{
    protected $fillable = ['part_number', 'component_name', 'vendor_manufacture', 'ata_chapter', 'capability_level', 'workshop', 'aircraft_type', 'for_rating',
                            'date_approval', 'authority', 'status', 'request_number', 'no_shop_ability', 'component_type', 'request_type', 'document',
                            'manhours_planning', 'personel', 'technical_data', 'major_equipment', 'customer',
                            'authority_value', 'date_approve', 'status_of_application'];
    // protected $casts = [
    //     'id' => 'int',
    //     'capability_level' => 'json',
    //     'for_rating' => 'json',
    //     'document' => 'json',
    //     'manhours_planning' => 'json',
    //     'personel' => 'json',
    // ];

    public function CapabilityRating(){
        return $this->hasMany(CapabilityRating::class);
    }

}
