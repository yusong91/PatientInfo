<?php

namespace Vanguard\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Vanguard\Patient;

class PatientImport implements ToModel, WithHeadingRow, WithChunkReading
{
//    private $users;

    public function __construct()
    {
//        $this->users = User::all(['id', 'name'])->pluck('id', 'name');
    }

    public function model(array $row)
    {
        return new Patient([
            'health_facility_id' => $row['health_facility_id'],
            'form_date' => $row['form_date'],
            'form_writer_name' => $row['form_writer_name'],
            'form_writer_phone' => $row['form_writer_phone'],
            'test_reason' => $row['test_reason'],
            'direct_exposure' => $row['direct_exposure'],
            'exposure_name' => $row['exposure_name'],
            'exposure_type' => $row['exposure_type'],
            'name' => $row['name'],
            'code' => $row['code'],
            'gender' => $row['gender'],
            'dob' => $row['dob'],
            'nation_id' => $row['nation_id'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'address_code' => $row['address_code'],
            'province' => $row['province'],
            'district' => $row['district'],
            'commune' => $row['commune'],
            'village' => $row['village'],
            'address_description' => $row['address_description'],
            'symptom_date' => $row['symptom_date'],
            'was_positive' => $row['was_positive'],
            'has_travel' => $row['has_travel'],
            'travel_place' => $row['travel_place'],
            'travel_date' => $row['travel_date'],
            'travel_no' => $row['travel_no'],
            'travel_id' => $row['travel_id'],
            'travel_chair' => $row['travel_chair'],
            'travel_description' => $row['travel_description'],
            'laboratory_name' => $row['laboratory_name'],
            'laboratory_date' => $row['laboratory_date'],
            'laboratory_id' => $row['laboratory_id'],
            'object_types_id' => $row['object_types_id'],
            'first_vaccine' => $row['first_vaccine'],
            'first_vaccine_date' => $row['first_vaccine_date'],
            'first_vaccine_type_id' => $row['first_vaccine_type_id'],
            'second_vaccine' => $row['second_vaccine'],
            'second_vaccine_date' => $row['second_vaccine_date'],
            'second_vaccine_type_id' => $row['second_vaccine_type_id'],
            'third_vaccine' => $row['third_vaccine'],
            'third_vaccine_date' => $row['third_vaccine_date'],
            'third_vaccine_type_id' => $row['third_vaccine_type_id'],
            'laboratory_collector' => $row['laboratory_collector'],
            'laboratory_collector_phone' => $row['laboratory_collector_phone'],
            'laboratory_file' => $row['laboratory_file'],
            'qr_data' => $row['qr_data'],
            'operator_data' => $row['operator_data'],
        ]);
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
