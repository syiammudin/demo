<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialRequest extends Model
{
    protected $fillable = ['request_submittion_id', 'no_document', 'request_type', 'part_number', 'engine_name',
                            'vendor_manufacturer', 'aircraft_type', 'ata_chapter', 'workshop', 'for_rating', 'request_number',
                            'facilities', 'special_tools', 'special_equipment', 'approved_data','qualified_personel',
                            'appropriate_rating', 'attachment','manual_revision','aproval_request_carry_out'] ;
}
