<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentShopAbility extends Model
{
    protected $fillable = ['request_submittion_id', 'shop_maintenance', 'shop_maintenance_no', 'summary_of_maintenance',
                           'test_equipment', 'special_tool', 'capability_level', 'qualified_personel', 'material_planning',
                           'manhours_planning', 'consumable_material','test_condition', 'storage_condition',
                           'manufacture_documentation_drawing', 'inspection', 'tool_equipment', 'special_work', 'particular', 'available_qualified'];


    protected $casts = [
        'id' => 'int',
        'summary_of_maintenance' => 'json',
        'capability_level' => 'json',
        'consumable_material' => 'json',
        'test_condition' => 'json',
        'storage_condition' => 'json',
    ];
}
