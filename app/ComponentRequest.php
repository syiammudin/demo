<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentRequest extends Model
{
    protected $fillable = ['component_type', 'component_name', 'vendor_manufacturer', 'aircraft_type','request_number',
                           'ata_chapter', 'workshop', 'for_rating', 'aproval_request_carry_out', 'manager_statement',
                           'part_number', 'status', 'tool_category', 'original_issued', 'rev_no', 'issued', 'distribution',
                           'efectifity', 'doc_no', 'reason_issuance', 'effect_maintenance_procedure', 'ability',
                           'reason_of_revision', 'recomended_tool', 'alternate_tool', 'maintenance_task', 'recomended',
                           'alternate', 'related_maintenance', 'note','equivalent_number','document_type','limitation','part_number_new'] ;

    // protected $casts = [
    //    'id' => 'int',
    //    'for_rating' => 'json',
    //    // 'aproval_request_carry_out' => 'json',
    //    'manager_statement' => 'json',
    // ];

}
