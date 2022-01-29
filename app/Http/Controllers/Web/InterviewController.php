<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Patient\CreatePatientRequest;
use Vanguard\Patient;
use Vanguard\Repositories\Patient\PatientRepository;
use Vanguard\CommonCode;

class InterviewController extends Controller 
{
    public $patientRepo;
    
     
    public function __construct(PatientRepository $repo)
    {
        $this->patientRepo = $repo;
    }

    public function interview($id){

        $submit = Patient::find($id);
        $submit->process_by_step2 = auth()->user()->id;
        $submit->save();
        
        $patient = $this->patientRepo->find($id);
        $health_facility = getConmunCode('health_facility');
        $reason_testing = getConmunCode('reason_testing');
        $clinical_symptom = getConmunCode('clinical_symptom');
        $type_specimen = getConmunCode('type_specimen');
        $gender = getConmunCode('gender');
        $lab_center = getConmunCode('lab_center');
        $number_sample = getConmunCode('number_sample');
        $vaccination = getConmunCode('vaccination');
        $type_vaccine = getConmunCode('type_vaccine');
        $covid_patient = getConmunCode('covid_patient');
        $provinces = getLocationCode('province');
        $nation = getConmunCode('nation');
        $related_patient = getConmunCode('related_patient');
        $variant = getConmunCode('variant');
        $interviewStatusList = getConmunCode('status_interview');
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        $patient_vaccine = getPatientVaccine($id);

        return view('patients.interview',compact('patient_vaccine','vaccination_list','patient', 'interviewStatusList', 'health_facility','reason_testing', 'clinical_symptom', 'type_specimen', 'gender', 'lab_center', 'number_sample', 'vaccination', 'type_vaccine', 'covid_patient', 'provinces', 'nation', 'related_patient', 'variant'));
    }

    public function setResearch(Request $request)
    {   
        $patient = $this->patientRepo->setSearch($request->patient_id, 1,  $request->status_id, $request->description);
        
        if($patient)
        {
            return redirect(route('list-tasks'));
        }
    }

    //Click To Search
    public function researchBasic($id)
    {   
    

        $submit = Patient::find($id);
        $submit->process_by_step5 = auth()->user()->id;
        $submit->save();

        $patient = $this->patientRepo->find($id);
        $health_facility = getConmunCode('health_facility');
        $reason_testing = getConmunCode('reason_testing');
        $clinical_symptom = getConmunCode('clinical_symptom');
        $type_specimen = getConmunCode('type_specimen');
        $gender = getConmunCode('gender');
        $lab_center = getConmunCode('lab_center');
        $number_sample = getConmunCode('number_sample');
        $vaccination = getConmunCode('vaccination');
        $type_vaccine = getConmunCode('type_vaccine');
        $covid_patient = getConmunCode('covid_patient');
        $provinces = getLocationCode('province');
        $nation = getConmunCode('nation');
        $related_patient = getConmunCode('related_patient');
        $variant = getConmunCode('variant');
        $interviewStatusList = getConmunCode('status_interview');

        $basic_to_search_status = getPatientCommond($patient->basic_to_search_status);
        
        return view('patients.research-basic',compact('patient', 'basic_to_search_status', 'interviewStatusList', 'health_facility','reason_testing', 'clinical_symptom', 'type_specimen', 'gender', 'lab_center', 'number_sample', 'vaccination', 'type_vaccine', 'covid_patient', 'provinces', 'nation', 'related_patient', 'variant'));
    }

    //BASIC INTERVIEW
    public function interviewStore(CreatePatientRequest $request)
    {
        if($request->submit_type == 'store') 
        {
            $patient = $this->patientRepo->interviewStore($request->id,$request->all());
            if($patient) 
            {
                return redirect(route('interview', $request->id))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            } 
 
        }elseif($request->submit_type == 'research') {

            $patient = $this->patientRepo->setSearch($request->patient_id, 1,$request->basic_note);
            if($patient)
            {
                return redirect(route('list-tasks'))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }

        }else{

            $patient = $this->patientRepo->basicInterviewDone($request->id,$request->all());
            if($patient)
            {
                return redirect(route('list-tasks'))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }
        }        
    }

    public function researchStoreDone(CreatePatientRequest $request)
    {   
        if($request->submit_type == 'done')
        {            
            $patient = $this->patientRepo->researchDone($request->id, $request->all());
            
            if($patient)
            {
                return redirect(route('list-tasks'))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }
 
        } else {
  
            $patient = $this->patientRepo->researchStore($request->id, $request->all());
            
            if($patient)
            {
                return redirect(route('list-tasks.research.show', $request->id))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }
        }
    }

    public function closeCase(Request $request)
    {
        $patient = $this->patientRepo->closeCase($request->id, $request->all());
            
        if($patient)
        {
            return redirect(route('list-tasks', $request->id));
        }
    }

    
}

