<?php

namespace Vanguard\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientFullinterviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'health_facility_id' => 'required',
            'form_date' => 'required',
            'laboratory_name' => 'required',
            'laboratory_date' => 'required',

        ];
    }

    
}
