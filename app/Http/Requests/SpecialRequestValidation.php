<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecialRequestValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_type' => 'required',
            'part_number' => 'required',
            'engine_name' => 'required',
            'vendor_manufacturer' => 'required',
            'aircraft_type' => 'required',
            'ata_chapter' => 'required',
            'workshop' => 'required',
            'shop_maintenance' => 'required',
            'shop_ability_number' => 'required',
            'ndt_method' => 'required',
            'reference' => 'required',
            // 'special_facility' => 'required',
            // 'qualified_personel' => 'required',
            // 'manufacture_documentation_drawing' => 'required',
            // 'inspection' => 'required',
            // 'tool_equipment' => 'required',
            // 'special_work' => 'required',
            // 'particular' => 'required',
            // 'available_qualified' => 'required',
        ];
    }
}
