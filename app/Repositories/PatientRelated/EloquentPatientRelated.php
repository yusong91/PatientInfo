<?php

namespace Vanguard\Repositories\PatientRelated;

use Vanguard\PatientRelated; 

class EloquentPatientRelated implements PatientRelatedRepository 
{

    public function all()
    {
        return PatientRelated::all();
    }

    public function create(array $data) 
    {
        $data['last_date'] = toDatabaseDateFormat($data['last_date']);
        
        return PatientRelated::create($data);
    } 

    public function update($id ,array $data){
        $data['last_date'] = toDatabaseDateFormat($data['last_date']);
        
        return PatientRelated::find($id)->update($data);
    }

    public function delete($id)
    {
        $PatientRelated = PatientRelated::find($id);

        return $PatientRelated->delete();
    }

    public function createOrUpdate(array $data, $id = null) {
        if ($id) {
            return $this->update($id, $data);
        }

        return $this->create($data);
    }

    public function newOrEdit($id) {
        if ($id) {
            return PatientRelated::find($id);
        }

        return new PatientRelated;
    }

    public function listByPatient($patientId) {

        $list = PatientRelated::where('patient_id', $patientId)->with(['sex'])->get();
        return $list;
    }

}