<?php

namespace Vanguard\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientTravelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'location_name' => 'required',
            'time' => 'required',
            'date' => 'required',
            'address' => 'required'
        ];
    }

    
}
