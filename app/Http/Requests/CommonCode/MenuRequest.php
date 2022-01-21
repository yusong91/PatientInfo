<?php

namespace Vanguard\Http\Requests\CommonCode;

use Vanguard\Http\Requests\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class MenuRequest extends Request
{

    public function rules()
    {
        return [
            // 'ordering' => 'required',
            // 'active' => 'required',
            'description' => 'required'
            //,'parent_id' => 'required'
        ];
    }
    
}
