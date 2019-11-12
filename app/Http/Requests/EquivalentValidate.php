<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquivalentValidate extends FormRequest
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
            'equivalent_number' => 'required' ,
            'tool_category'  => 'required',
            'original_issued' => 'required',
            'rev_no' => 'required',
            'issued' => 'required',
            'distribution' => 'required',
            'efectifity' => 'required',
            'doc_no' => 'required',
            'reason_issuance' => 'required',
            'effect_maintenance_procedure' => 'required',
            'ability' => 'required',
            'reason_of_revision' => 'required',
            'recomended_tool' => 'required',
            'alternate_tool' => 'required',
            'maintenance_task' => 'required',
            'recomended' => 'required',
            'alternate' => 'required',
            'related_maintenance' => 'required',
            'note' => 'required'
        ];
    }
}
