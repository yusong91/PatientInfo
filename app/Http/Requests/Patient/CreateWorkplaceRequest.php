<?php

namespace Vanguard\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorkplaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

        ];
    }

    
}
