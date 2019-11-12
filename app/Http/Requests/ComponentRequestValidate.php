<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComponentRequestValidate extends FormRequest
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
            'component_type'  => 'required',
            'component_name'  => 'required',
            'vendor_manufacturer'  => 'required',
            'aircraft_type' => 'required',
            'ata_chapter' => 'required',
            'workshop' => 'required',
            'for_rating' => 'required',
            'aproval_request_carry_out' => 'required',
            'manager_statement' => 'required',
            'part_number' => 'required',
            'status' => 'required',
            'shop_maintenance_no' => 'required',
            'summary_of_maintenance' => 'required',
            'request_type' => 'required',
            // 'document_type' => 'required',
        ];
    }
}
