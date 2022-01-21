<?php

namespace Vanguard\Repositories\PatientHistory;

use Vanguard\PatientHistory; 

class EloquentPatientHistory implements PatientHistoryRepository 
{

    public function all()
    {
        return PatientHistory::all();
    }

    public function create(array $data) 
    {
        $data['test_date'] = toDatabaseDateFormat($data['test_date']);
        $data['result_date'] = toDatabaseDateFormat($data['result_date']);
        $data['symptoms_date'] = toDatabaseDateFormat($data['symptoms_date']);

        return PatientHistory::create($data);
    } 

    public function update($id ,array $data){
        $data['test_date'] = toDatabaseDateFormat($data['test_date']);
        $data['result_date'] = toDatabaseDateFormat($data['result_date']);
        $data['symptoms_date'] = toDatabaseDateFormat($data['symptoms_date']);

        return PatientHistory::find($id)->update($data);
    }

    public function delete($id)
    {
        $patientHistory = PatientHistory::find($id);

        return $patientHistory->delete();
    }

    public function createOrUpdate(array $data, $id = null) {
        if ($id) {
            return $this->update($id, $data);
        }

        return $this->create($data);
    }

    public function newOrEdit($patientId) {
        $edit  = PatientHistory::where('patient_id', $patientId)->first();
        if($edit) {
            return $edit;
        }
        
        return new PatientHistory();
    }
}