<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorManagementValidate extends FormRequest
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
            'from' => 'required' ,
            'to' => 'required' ,
            'phone' => 'required|numeric' ,
            'vendor_name' => 'required' ,
            'vendor_address' => 'required' ,
            'vendor_city' => 'required' ,
            'vendor_state' => 'required' ,
            'vendor_zip_code' => 'required|numeric' ,
            'vendor_phone' => 'required|numeric' ,
            'vendor_fax' => 'required|numeric' ,
            'parent_company' => 'required' ,
            'item_proposed' => 'required' ,
            'aplication_drawing' => 'required' ,
            'type_supplier' => 'required' ,
            'contact_name' => 'required' ,
            'contact_email' => 'required|email' ,
            'contact_title' => 'required' ,
            'supplier_code' => 'required' ,
        ];
    }
}
