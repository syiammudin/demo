<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialShopAbility extends Model
{
    protected $fillable = ['request_submittion_id', 'shop_maintenance', 'shop_ability_number', 'summary_of_maintenance',
                            'document_required', 'test_equipment_part_number', 'test_equipment_part_name',
                            'special_tool_part_number', 'special_tool_part_name', 'remark', 'manufacture_documentation_drawing',
                            'inspection', 'tool_equipment', 'special_work', 'particular', 'available_qualified', 'ability',
                            'ability_inspection', 'ability_testing', 'ability_modification', 'ability_repair',
                            'ability_overhauled', 'consumable_material',
                            'ndt_method',
                            'reference',
                            'special_facility',
                            // 'qualified_personel',
                            'equipment_tools'
                            ] ;
}
