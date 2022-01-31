<?php

namespace Vanguard\Repositories\Patient;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Vanguard\ObjectType;
use Vanguard\Patient;
use Vanguard\PatientFamily;
use Vanguard\PatientTravel;
use Vanguard\Symptom;
use Vanguard\Health;
use Vanguard\Vaccine;
use Vanguard\CommonCode;

class EloquentPatient implements PatientRepository
{   

    //step6=interiew again, step5=research

    public function listTast($status_id = 1, $step = null, $step_id = null, $process_by_step = 1)
    {
        $query = Patient::where(['status'=>$status_id, 'process_by_step'.$process_by_step => null]);

        if ($step && $step_id) {
            $query->where(function ($q) use ($step, $step_id) {
                $q->where($step, $step_id);
            });
        } 
        $result = $query->orderBy('created_at', 'desc')->get();
        return $result;
    }

    public function paginate($perPage, $search = null, $status = null, $user_id = null)
    {   
     
        $query = Patient::query();

        //$query = Patient::where(['status'=>$status, 'process_by_step'.($status+1)=>null]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
                $q->orWhere('dob', 'like', "%{$search}%");
                $q->orWhere('travel_place', 'like', "%{$search}%");
                $q->orWhere('code', 'like', "%{$search}%");
            });
        } 
        
        if($status){

            $query->where(function ($q) use ($status, $user_id) { 
                
                $q->where(['status'=>6, 'process_by_step4'=>$user_id]);
                $q->orWhere(['status'=>$status, 'process_by_step'.($status+1)=>null]);
            });

        }
 
        $result = $query->orderBy('created_at', 'desc')->with(['symptom','hospital','sex','getProvince', 'health'])->paginate($perPage);
        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    public function paginatePatient($perPage, $search = null, $status = null, $user_id = null)
    {   
        $query = Patient::where('status', 1);
        
        //query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
                $q->orWhere('dob', 'like', "%{$search}%");
                $q->orWhere('travel_place', 'like', "%{$search}%");
                $q->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        $result = $query->orderBy('created_at', 'desc')->with(['symptom','hospital','sex','getProvince', 'health'])->paginate($perPage);
        if ($search) {
            $result->appends(['search' => $search]);
        }

        return $result;
    }

    public function getByProcess($search = null, $status = 1, $step, $process)
    {
        $query = Patient::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
                $q->orWhere('dob', 'like', "%{$search}%");
                $q->orWhere('travel_place', 'like', "%{$search}%");
                $q->orWhere('code', 'like', "%{$search}%");
            });
        }

        if($status){
            $query->where(function ($q) use ($status) {
                $q->where("status", $status);
            });
        }

        if($process){
            $query->where(function ($q) use ($process) {
                $q->where($process, auth()->user()->id);
            });
        }

        $result = $query->orderBy('created_at', 'desc')->with(['symptom','hospital','sex','getProvince'])->get();

        return $result;
    }

    public function getByStep($search = null, $status = 1, $step)
    {
        $query = Patient::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', "like", "%{$search}%");
                $q->orWhere('phone', 'like', "%{$search}%");
                $q->orWhere('dob', 'like', "%{$search}%");
                $q->orWhere('travel_place', 'like', "%{$search}%");
                $q->orWhere('code', 'like', "%{$search}%");
            });
        }
        

        if($step){
            $query->where(function ($q) use ($step) {
                $q->where($step, auth()->user()->id);
            });
        }

        $result = $query->orderBy('created_at', 'desc')->with(['symptom','hospital','sex','getProvince'])->get();
        
        return $result;
    }

    public function all() 
    {
        return Patient::all(); 
    }

    public function patientByStatusStep($status, $step, $user_id)
    {
        return Patient::where(['status'=>$status, $step=>$user_id])->get();
    }

    public function allPatientByStatus($status)
    {
        return Patient::where('status', $status)->get();
    }

    public function find($id)
    {
        return Patient::find($id);
    } 

    public function findPatientWithBTSQrcode($id)
    {
        return Patient::with('getAttachBts')->with('getAttachQrCode')->find($id);
    }

    public function findBy($field, $value)
    {
        return Patient::where($field, $value)->first();
    }

    public function whereType($type)
    {
        return Patient::whereType($type)->get();
    }

    public function create($data)
    {
        $digital_file = "";
        if(isset($data["laboratory_file"]))
        { 
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('labform', $file);
        }
        $code = '';
        $rowDate = Carbon::now();
        $date = $rowDate->format('d m Y');
        $dateSpite = explode(" ", $date);
        if($data["name"])
        {
            $nameSpit = explode(" ", $data["name"]);

            $count = Patient::count();

            $count += 267479;

            if(!preg_match('/[^A-Za-z0-9]/', $data["name"]))
            {   
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper((substr($nameSpit[0], -1).substr($nameSpit[1], -1))).($count + 1);
            
            } else {

                $firstName = $nameSpit[0];

                $secondName = $nameSpit[1];

                $first_key = mb_substr($firstName, 0, 1, 'utf-8');

                $second_key = mb_substr($secondName, 0, 1, 'utf-8');
            
                $keyName = getKeyName($first_key, $second_key);
            
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper($keyName).($count + 1);
            }
        }

        $patient = new Patient(); 
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->name = $data["name"];
        $patient->gender = $data["gender"];
        $patient->dob = $this->getDate($data["dob"]);
        $patient->nation_id = $data["nation_id"];
        $patient->phone = $data["phone"];
        $patient->second_phone = $data["second_phone"] ?? 'null';
        $patient->code = $code;
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"];
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->patient_age = $data['patient_age'];
        $patient->status = 1;
        $patient->step1 =  auth()->user()->id;
        $patient->process_by_step1 =  auth()->user()->id;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->status_message = 1;
        $patient->save();
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;

        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on'){

                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_date']) ? $this->getDate($data[$item->key.'_date']) : null;
                $vaccine->save();
            }
        }

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }
        return $patient;
    }

    public function update($id,$data)
    {
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();

        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = "";
        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }

        $code = '';
        $rowDate = Carbon::now();
        $date = $rowDate->format('d m Y');
        $dateSpite = explode(" ", $date);

        if($data["name"])
        {
            $nameSpit = explode(" ", $data["name"]);

            $count = substr($data["code"], 8);

            if(!preg_match('/[^A-Za-z0-9]/', $data["name"]))
            {   
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper((substr($nameSpit[0], -1).substr($nameSpit[1], -1))).($count);
            
            } else {

                $firstName = $nameSpit[0];
                $secondName = $nameSpit[1];
                $first_key = mb_substr($firstName, 0, 1, 'utf-8');
                $second_key = mb_substr($secondName, 0, 1, 'utf-8');
                $keyName = getKeyName($first_key, $second_key);
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper($keyName).($count);
            }
        }

        $patient = Patient::find($id);
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->name = $data["name"];
        $patient->gender = $data["gender"];
        $patient->dob = $this->getDate($data["dob"]);
        $patient->nation_id = $data["nation_id"];
        $patient->phone = $data["phone"];
        $patient->second_phone = $data["second_phone"];
        $patient->code = $code;
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->patient_age = $data['patient_age'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }

        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_date']) ? $this->getDate($data[$item->key.'_date']) : null;
                $vaccine->save();
            }
        }

        return $patient;
    }

    public function delete($id)
    {
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }
        $patient = $this->find($id);
        return $patient->forceDelete();
    }

    public function getDate($data){

        if(is_null($data)){
            return null;
        }

        $time = strtotime(str_replace('/', '-', $data));
        $newformat = date('Y-m-d', $time);
        return $newformat;
    }
    
    function import($files) {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        DB::beginTransaction();
        try {
            foreach ($files as $file) {
                Excel::import(new Patient, $file);
            }
            DB::commit();
            return [
                'success' => true,
                'message' => 'Completed!!!'
            ];
        } catch (ValidationException $ex) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }

    //Basic interview
    public function interviewStore($id, $data)
    {
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = "";
        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }

        $patient = Patient::findOrfail($id);
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->gender = $data["gender"];
        $patient->dob = isset($data["dob"]) ? $this->getDate($data["dob"]): null;
        $patient->nation_id = $data["nation_id"];
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->patient_age = $data['patient_age'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->second_phone = isset($data["second_phone"]) ? $data["second_phone"] : null;

        if($patient->name != $data["name"])
        {
            $patient->real_name = $data["name"];
        }

        if($patient->dob != (String)$this->getDate($data['dob']))
        {
            $patient->real_dob =  $this->getDate($data['dob']);
        }
        
        if($patient->phone != $data["phone"])
        {
            $patient->real_phone = $data["phone"];
        }

        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }
        
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_date']) ? $this->getDate($data[$item->key.'_date']) : null;
                $vaccine->save();
            }
        }
        return $patient;
    } 

    public function basicInterviewDone($id, $data)
    {   
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = "";
        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }

        $patient = Patient::findOrfail($id);

        $patient->status = 2; 

        $patient->status_message = 2;

        $patient->step2 = auth()->user()->id;
        
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->gender = $data["gender"];
        $patient->dob = isset($data["dob"]) ? $this->getDate($data["dob"]): null;
        $patient->nation_id = $data["nation_id"];
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->patient_age = $data['patient_age'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->second_phone = isset($data["second_phone"]) ? $data["second_phone"] : null;

        if($patient->name != $data["name"])
        {
            $patient->real_name = $data["name"];
        }

        if($patient->dob != (String)$this->getDate($data['dob']))
        {
            $patient->real_dob =  $this->getDate($data['dob']);
        }
        
        if($patient->phone != $data["phone"])
        {
            $patient->real_phone = $data["phone"];
        }

        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }

        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_date']) ? $this->getDate($data[$item->key.'_date']) : null;
                $vaccine->save();
            }
        }
        return $patient;
    }

    public function fullInterviewStore($id, $data)
    {   
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }

        $health = health::where('patient_id',$id)->get();
        foreach ($health as $item){
            $item->delete();
        }

        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = "";
        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }

        $patient = Patient::findOrfail($id);
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->gender = $data["gender"];
        $patient->nation_id = $data["nation_id"];
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->patient_age = $data['patient_age'];
        $patient->real_name = $data["real_name"];
        $patient->real_dob =  $this->getDate($data['real_dob']);
        $patient->real_phone = $data["real_phone"];
        $patient->second_phone = $data["second_phone"];
        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }

        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }

        if(isset($data["health_histories"])){
            foreach ($data["health_histories"] as $item)
            {
                $health =new Health();
                $health->health_id = $item;
                $health->patient_id = $patient->id;
                $health->save();
            }
        }
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_date']) ? $this->getDate($data[$item->key.'_date']) : null;
                $vaccine->save();
            }
        }
        
        return $patient;
    }
 
    public function fullInterviewWorkplaceStore($id, $data)
    {   

        $patient = Patient::findOrfail($id);
        $patient->workplace_phone = $data["workplace_phone"];
        $patient->workplace_amount_staff = $data["workplace_amount_staff"];
        $patient->workplace_address = $data["workplace_address"];
        $patient->workplace_name = $data["workplace_name"];
        $patient->workplace_company = $data["workplace_company"];
        $patient->workplace_note = $data["workplace_note"];
        $patient->save();
        return $patient;
    }

    public function patientFamilyStore($data)
    {
        $patientFamily = new PatientFamily(); 
        $patientFamily->patient_id = $data["patient_id"];
        $patientFamily->name = $data["name"];
        $patientFamily->gender = $data["gender"];
        $patientFamily->person_age = $data["person_age"];
        $patientFamily->phone = $data["phone"];
        $patientFamily->last_touch_date = $this->getDate($data["last_touch_date"]);
        $patientFamily->test_result = $data["test_result"];
        $patientFamily->family_member = $data["family_member"];
        $patientFamily->note = $data["note"]; 
        $patientFamily->second_phone = $data["second_phone"] ?? null;
        $patientFamily->save();
        return $patientFamily;
    }

    public function checkDuplicate($key)
    {
        return Patient::where($key)->first();
    }

    //Full Interview
    public function interviewDone($id)
    {
        $patient = Patient::findOrfail($id);

        $patient->status = 4; 

        $patient->status_message = 4; 

        $patient->step4 = auth()->user()->id;

        $patient->save();

        return $patient;
    }

    public function researchDone($id, $data)
    {   
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = "";
        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }

        $patient = Patient::findOrfail($id);

        if($patient->source_research == '1')
        {
            $patient->status = 2;
            $patient->step2 =  auth()->user()->id;
            $patient->process_by_step5 =  auth()->user()->id;

        } else {

            $patient->status = 3;
            $patient->process_by_step5 =  auth()->user()->id;
            $patient->process_by_step4 =  null;
            $patient->step4 =  null;
        }

        $patient->status_message = 6;

        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->gender = $data["gender"];
        $patient->nation_id = $data["nation_id"];
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->patient_age = $data['patient_age'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->second_phone = isset($data["second_phone"]) ? $data["second_phone"] : null;
        $patient->general_note = isset($data["general_note"]) ? $data["general_note"] : null;

        if($patient->name != $data["name"])
        {
            $patient->real_name = $data["name"];
        }

        if($patient->dob != (String)$this->getDate($data['dob']))
        {
            $patient->real_dob =  $this->getDate($data['dob']);
        }
        
        if($patient->phone != $data["phone"])
        {
            $patient->real_phone = $data["phone"];
        }

        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_type_id']) ? $this->getDate($data[$item->key.'_type_id']) : null;
                $vaccine->save();
            }
        }
        return $patient;
    }

    public function researchStore($id,$data)
    {
        $patient_vaccine = Vaccine::where('patient_id', $id)->delete();
        $symptom = Symptom::where('patient_id',$id)->get();
        foreach ($symptom as $item){
            $item->delete();
        }
        $objectType = ObjectType::where('patient_id',$id)->get();
        foreach ($objectType as $item){
            $item->delete();
        }

        $digital_file = ""; 

        if(isset($data["laboratory_file"]))
        {
            $file = $data["laboratory_file"];
            $digital_file = Storage::putFile('patients', $file);
        }else{
            $digital_file = $data["laboratory_file_row"] ?? "";
        }
        $patient = Patient::findOrfail($id);
        $patient->health_facility_id = $data["health_facility_id"];
        $patient->form_date = $this->getDate($data["form_date"]);
        $patient->form_writer_name = $data["form_writer_name"];
        $patient->form_writer_phone = $data["form_writer_phone"];
        $patient->test_reason = $data["test_reason"] ?? 0;
        $patient->direct_exposure = isset($data["direct_exposure"]) ? ($data["direct_exposure"]=='on' ? 1 : 0) : 0;
        $patient->exposure_name = $data["exposure_name"] ?? '';
        $patient->exposure_type =  $data["exposure_type"] ?? 0;
        $patient->gender = $data["gender"];
        $patient->dob = isset($data["dob"]) ? $this->getDate($data["dob"]) : null;
        $patient->nation_id = $data["nation_id"];
        $patient->address = $data["address"];
        $patient->province = $data["province"];
        $patient->district = $data["district"] ?? "";
        $patient->commune = $data["commune"] ?? "";
        $patient->village = $data["village"] ?? "";
        $patient->address_description = $data["address_description"] ?? '';
        $patient->symptom_date = $this->getDate($data["symptom_date"]);
        $patient->was_positive =  $data["was_positive"] ?? 0;
        $patient->address_description = $data["address_description"] ?? '';
        $patient->travel_place = $data["travel_place"];
        $patient->travel_date = $this->getDate($data["travel_date"]);
        $patient->travel_no = $data["travel_no"];
        $patient->travel_id = $data["travel_id"];
        $patient->travel_chair = $data["travel_chair"];
        $patient->travel_description = $data["travel_description"];
        $patient->virus_type = $data["virus_type"] ?? 0;
        $patient->number_sample_id = $data["number_sample_id"] ?? 0;
        $patient->laboratory_name = $data["laboratory_name"];
        $patient->laboratory_date = $this->getDate($data["laboratory_date"]);
        $patient->laboratory_id = $data["laboratory_id"];
        $patient->laboratory_collector = isset($data["laboratory_collector"]) ? $data["laboratory_collector"] : null;
        $patient->laboratory_collector_phone =  isset($data["laboratory_collector"]) ? $data["laboratory_collector_phone"] : null;
        $patient->laboratory_file =  $digital_file;
        $patient->positive_date = $this->getDate($data['positive_date']);
        $patient->job = $data['job'];
        $patient->general_note = $data['general_note'];

        if($patient->dob != (String)$this->getDate($data['dob']))
        {
            $patient->real_dob =  $this->getDate($data['dob']);
        }

        if($patient->name != $data["name"])
        {
            $patient->real_name = $data["name"];
        }

        if($patient->real_phone != $data["phone"])
        {
            $patient->real_phone = $data["phone"];
        }

        $patient->patient_age = $data['patient_age'];
        $patient->death = isset($data["death"]) ? $data["death"] : 'off';
        $patient->labform_province = isset($data["labform_province"]) ? $data["labform_province"] : null;
        $patient->second_phone = isset($data["second_phone"]) ? $data["second_phone"] : null;
        $patient->general_note = isset($data["general_note"]) ? $data["general_note"] : null;
        $patient->save();

        if(isset($data["object_types_id"])){
            foreach ($data["object_types_id"] as $item) 
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }

        if(isset($data["clinical_symtom"])){
            foreach ($data["clinical_symtom"] as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }

        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        foreach($vaccination_list as $item)
        {
            if(isset($data[$item->key]) == 'on')
            {
                $vaccine = new Vaccine();
                $vaccine->patient_id = $patient->id;
                $vaccine->number_vaccine = $item->key;
                $vaccine->vaccine_type_id = $data[$item->key.'_type_id'];
                $vaccine->date = isset($data[$item->key.'_type_id']) ? $this->getDate($data[$item->key.'_type_id']) : null;
                $vaccine->save();
            }
        }

        return $patient;
    }
    
    public function setSearch($id, $source_research, $status_search_id, $search_description)
    {
        $patient = Patient::findOrfail($id);

        $patient->status = 5;

        $patient->status_message = 5;

        $patient->process_by_step5 = null;

        if($source_research == 1)
        {
            $patient->step2 = null;
            
            $patient->basic_to_search_status = $status_search_id;

            $patient->basic_to_search_description = $search_description;

            $patient->process_by_step2 = null;

        } else {

            $patient->full_to_search_status = $status_search_id;

            $patient->full_to_search_description = $search_description;

            $patient->step4 = auth()->user()->id;

            $patient->process_by_step4 = null;

        }

        $patient->source_research = $source_research;

        $patient->save();

        return $patient;
    } 

    public function fullInterviewAgain($data)
    {
        $patient = Patient::findOrfail($data['patient_id']);
        $patient->status_message = 7;
        $patient->status = 6;
        $patient->process_by_step6 =  auth()->user()->id;
        $patient->step4 = null;
        $patient->interview_status = $data['interview_status'];
        $patient->superior_descript = $data['superior_descript'];
        $patient->save();
        return $patient;
    }

    public function superiorFinish($patient_id)
    {
        $patient = Patient::findOrfail($patient_id);
        $patient->status_message = 8;
        $patient->status = 8;
        $patient->process_by_step6 = auth()->user()->id;
        $patient->save();
        return $patient;
    }

    public function closeCase($id, $data)
    {
        $patient = Patient::findOrfail($id);
        $patient->status_message = 9;
        $patient->status = 9;
        $patient->close_case = $data['close_case'];
        $patient->case_descript = $data['description'];
        $patient->process_by_step5 = auth()->user()->id;
        $patient->step5 = auth()->user()->id;
        $patient->save();
        return $patient;
    }

}


//status_message = 9 close case
//status = 9 close case
