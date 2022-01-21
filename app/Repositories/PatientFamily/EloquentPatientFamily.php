<?php

namespace Vanguard\Repositories\PatientFamily;

use Vanguard\PatientFamily; 

class EloquentPatientFamily implements PatientFamilyRepository 
{

    public function all()
    {
        return PatientFamily::all();
    }

    public function find($id)
    {
        return PatientFamily::find($id);
    }

    public function create(array $data) 
    {
        $data['last_touch_date'] = toDatabaseDateFormat($data['last_touch_date']);
        
        return PatientFamily::create($data);
    } 

    public function update($id ,array $data){
        
        $data['last_touch_date'] = toDatabaseDateFormat($data['last_touch_date']);
        
        return PatientFamily::find($id)->update($data);
    }

    public function delete($id)
    {
        $PatientFamily = PatientFamily::find($id);

        return $PatientFamily->delete();
    }

    public function listByPatient($patientId) {
        $list = PatientFamily::where('patient_id', $patientId)->with(['sex', 'result'])->get();
        return $list;
    }

}