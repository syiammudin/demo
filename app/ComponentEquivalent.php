<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentEquivalent extends Model
{
    protected $fillable = ['request_submittion_id','component_test_equipment_id', 'equivalent_number', 'tool_category', 'original_issued', 'rev_no', 'issued', 'distribution',
                           'efectifity', 'doc_no', 'reason_issuance', 'effect_maintenance_procedure', 'ability', 'reason_of_revision', 'recomended_tool',
                           'alternate_tool', 'maintenance_task', 'recomended', 'alternate', 'related_maintenance', 'note'] ;

    protected $casts = [
        'id' => 'int',
        'related_maintenance' => 'array',
        'alternate' => 'json',
        'recomended' => 'json',
        'maintenance_task' => 'json',
        'alternate_tool' => 'json',
        'recomended_tool' => 'json',
    ] ;
}
