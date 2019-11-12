<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EngineShopAbility extends Model
{
    protected $fillable = ['request_submittion_id','shop_maintenance', 'number_ability', 'summary_of_maintenance', 'document_requirement',
                            'test_equiptment', 'test_equipment_part_number', 'test_equipment_part_name', 'special_tool_part_number',
                            'special_tool_part_name', 'remark', 'manufacture_documentation_drawing', 'inspection',
                            'tool_equipment', 'special_work', 'particular', 'available_qualified', 'ablity', 'consumable_material',
                            'shop_ability','part_name','part_number', 'ability',
                            'ability_inspection', 'ability_testing', 'ability_repair', 'ability_modification', 'ability_overhauled'];
    protected $casts = [
        'id' => 'int',
        'summary_of_maintenance' => 'json',
        'consumable_material' => 'array',
    ];

    // public function getConsumableMaterialAttribute($v) {
    //     return json_decode($v);
    // }
}
