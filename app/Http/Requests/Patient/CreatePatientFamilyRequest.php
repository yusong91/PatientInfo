<?php

namespace Vanguard\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientFamilyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'last_touch_date' => 'required'
        ];
    }

    
}
