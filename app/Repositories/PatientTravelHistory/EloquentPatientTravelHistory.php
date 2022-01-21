<?php

namespace Vanguard\Repositories\PatientTravelHistory;

use Vanguard\PatientTravel; 


class EloquentPatientTravelHistory implements PatientTravelHistoryRepository 
{ 
    public function all()
    {
        return PatientTravel::all();
    }

    public function create($data)
    {
        $patientTravel = new PatientTravel(); 
        $patientTravel->patient_id = $data["patient_id"];
        $patientTravel->location_name = $data["location_name"];
        $patientTravel->time = $data["time"];//date('H:i', strtotime('23-11-2021 12:12:12')); 
        $patientTravel->date = $this->getDate($data["date"]);
        $patientTravel->address = $data["address"];
        $patientTravel->start_date = $this->getDate($data["start_date"]);
        $patientTravel->note = $data["note"];
        $patientTravel->save();
        return $patientTravel;
    }

    public function update($id ,array $data){

        $data['start_date'] = toDatabaseDateFormat($data['start_date']);
        
        $data['date'] = toDatabaseDateFormat($data['date']);
        
        return PatientTravel::find($id)->update($data);
    }

    public function delete($id)
    {
        $PatientFamily = PatientTravel::find($id);

        return $PatientFamily->delete();
    }

    public function listByPatient($patientId) {
        $list = PatientTravel::where('patient_id', $patientId)->get();
        return $list;
    }

    public function getDate($data){

        if(is_null($data)){
            return null;
        }
        $time = strtotime(str_replace('/', '-', $data));
        $newformat = date('Y-m-d', $time);
        return $newformat;
    }

    public function find($id)
    {
        return PatientTravel::find($id);
    }

}