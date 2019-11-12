<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineRequest extends Model
{
    protected $fillable = ['request_submittion_id', 'part_number', 'request_type', 'engine_name', 'vendor_manufacturer',
                            'aircraft_type', 'ata_chapter', 'workshop', 'dgca_rating', 'faa_rating', 'easa_rating','request_number',
                            'facilities', 'special_tools', 'qualified_personel', 'approved_data',
                            'appropriate_rating', 'status','approval_request_type','attachment','for_rating'];
                            // 'special_equipment'
}
