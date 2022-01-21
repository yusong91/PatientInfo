<?php

namespace Vanguard\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//
            'health_facility_id' => 'required',
            'form_date' => 'required',
////            'form_writer_name' => 'required',
////            'form_writer_phone' => 'required',
////            'test_reason' => 'required',
////            'direct_exposure' => 'required',
////            'exposure_name' => 'required',
////            'exposure_type' => 'required',
            'name' => 'required',
////            'code' => 'required',
            'gender' => 'required',
//            'dob' => 'required',
//            'nation_id' => 'required',
            'phone' => 'required',
//            'address' => 'required',
////            'address_code' => 'required',
////            'address_description' => 'required',
////            'symptom_date' => 'required',
//            'was_positive' => 'required',
////           // 'has_travel' => 'required',
//            'travel_place' => 'required',
//            'travel_date' => 'required',
//            'travel_no' => 'required',
//            'travel_id' => 'required',
//            'travel_chair' => 'required',
//            'travel_description' => 'required',
            'laboratory_name' => 'required',
            'laboratory_date' => 'required',
//            'laboratory_id' => 'required',
//            'object_types_id' => 'required',
////            'first_vaccine' => 'required',
////            'first_vaccine_date' => 'required',
////            'first_vaccine_type_id' => 'required',
////            'second_vaccine' => 'required',
////            'second_vaccine_date' => 'required',
////            'second_vaccine_type_id' => 'required',
////            'third_vaccine' => 'required',
////            'third_vaccine_date' => 'required',
////            'third_vaccine_type_id' => 'required',
//            'laboratory_collector' => 'required',
//            'laboratory_collector_phone' => 'required',
//            'laboratory_file' => 'required',
//            'qr_data' => 'required',
//            'operator_data' => 'required',
        ];
    }

    
}
