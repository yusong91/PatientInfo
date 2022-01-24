<?php

namespace Vanguard\Http\Controllers\Web;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Vanguard\Excel\ExcelPatient;
use Illuminate\Support\Facades\DB;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Patient;
use Vanguard\Repositories\Patient\PatientRepository;
use Vanguard\Repositories\Attach\AttachBtsRepository;
use Vanguard\Repositories\Attach\AttachQrcodeRepository;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Vanguard\Model\ImportBTSFile;
use Vanguard\Model\ImportQrcodeFile;
use Vanguard\Repositories\PatientRelated\PatientRelatedRepository;
use Vanguard\Repositories\PatientHistory\PatientHistoryRepository;
use Vanguard\Repositories\PatientFamily\PatientFamilyRepository;
use Vanguard\Repositories\PatientTravelHistory\PatientTravelHistoryRepository;
use Vanguard\Http\Requests\Patient\CreatePatientRequest;
use Vanguard\Http\Requests\Patient\CreatePatientFamilyRequest;
use Vanguard\Http\Requests\Patient\CreatePatientTravelRequest;
use Vanguard\Http\Requests\Patient\CreateWorkplaceRequest;
use Vanguard\Http\Requests\Patient\CreatePatientFullinterviewRequest;


class ListTasksController extends Controller
{
    private $patient;
    private $attachBts;
    private $patientHistory;
    private $patientRelated;
    private $patientFamily;
    private $patientTravel;
    private $attachQrcode; 

    public function __construct(
        PatientRepository $patient,
        attachBtsRepository $attachBts,
        AttachQrcodeRepository $attachQrcode,
        PatientHistoryRepository $patientHistory,
        PatientRelatedRepository $patientRelated,
        PatientFamilyRepository $patientFamily,
        PatientTravelHistoryRepository $patientTravel
    ) { 
        $this->patient = $patient;
        $this->attachBts = $attachBts;
        $this->attachQrcode = $attachQrcode;
        $this->patientHistory = $patientHistory;
        $this->patientRelated = $patientRelated;
        $this->patientFamily = $patientFamily;
        $this->patientTravel = $patientTravel;
        
    }

    public function index()
    {   
        $status = null;
        $role_id = auth()->user()->role_id;

        if ($role_id == 4) {
            $status = 1;
        } elseif ($role_id == 5) {
            $status = 2;
        } elseif ($role_id == 6) {
            $status = 3;
        } elseif ($role_id == 9) {
            $status = 5;
        } else {
            $status = null;
        }

        $patients = $this->patient->paginate(
            $perPage = 500,
            null,  
            $status,
            auth()->user()->id
        ); 

        return view('list-tasks/list-tasks', compact('patients', 'role_id'));
    }

    public function report()
    {
        return view('report.index');
    }

    public function excel(){

        $role_id = auth()->user()->role_id;

        if ($role_id == 4) {
            $status = 1;
        } elseif ($role_id == 5) {
            $status = 2;
        } elseif ($role_id == 6) {
            $status = 3;
        } elseif ($role_id == 9) {
            $status = 5;
        } else {
            $status = null;
        }
        $patients = DB::table('patients')->where("status",$status)->get(['name', 'phone', 'laboratory_date']);

        return Excel::download(new ExcelPatient($patients), 'patient.xlsx');

    }

    public function tasksDone()
    {
        $step = 1;
        $status = null;
        $role_id = auth()->user()->role_id;
        
        if ($role_id == 4) {
            $step = "step2";
            $status = 1;
        } elseif ($role_id == 5) {
        
            $step = "step3";
            $status = 3;
        } elseif ($role_id == 6) {
            $step = "step4";
            $status = 3;
        } elseif ($role_id == 9) {
            $step = "step2";
            $status = 2;
        } else {
            $status = null;
        }

        $patient = $this->patient->getByStep(
            null,
            $status,
            $step
        );

        return view('list-tasks.tasks-done',["patient"=>$patient,"role_id"=>$role_id]);
    }
    
    public function tasksProcess()
    {
        $step = 1;
        $status = null;
        $role_id = auth()->user()->role_id;
        if ($role_id == 4) {
            $process_by_step = "process_by_step2";
            $step = "step2";
            $status = 1;
        } elseif ($role_id == 5) {
            $process_by_step = "process_by_step3";
            $step = "step3";
            $status = 2;
        } elseif ($role_id == 6) {
            $process_by_step = "process_by_step4";
            $step = "step4";
            $status = 3;
        } elseif ($role_id == 9) {
            $process_by_step = "process_by_step5";
            $step = "step5";
            $status = 5;
        } else {
            $status = null;
        }

        $patient = $this->patient->getByProcess(
            null,
            $status,
            $step,
            $process_by_step
        );

        return view('list-tasks.tasks-process',["patient"=>$patient,"role_id"=>$role_id]);
    }
 
    public function show($id)
    {
        $submit = Patient::find($id);
        $user_id = auth()->user()->id;
        $role_id = auth()->user()->role_id;
        
        switch ($role_id) {
            case 4:
                $submit->process_by_step2 = $user_id;
                $submit->save();

                return redirect()->route('list-tasks.basicinterview', $id);
                break;

            case 5:
                $submit->process_by_step3 = $user_id;
                $submit->save();

                return redirect()->route('list-tasks.datatechnical', $id);
                break;

            case 6:
                $submit->process_by_step4 = $user_id;
                $submit->save();

                return redirect()->route('list-tasks.fullinterview', $id);
                break;

            case 9:

                $submit->process_by_step5 = $user_id;
                $submit->save(); 
                    return redirect()->route('list-tasks.research.show', $id);
                    break; 
                
            default:
                '';
                break;
        }
    } 

    public function basicInterview($id)
    {
        $patient = $this->patient->findPatientWithBTSQrcode($id);

        return view('list-tasks.basic-interview', compact('patient'));
    }

    public function dataTechnical($id)
    {
        $patient = $this->patient->findPatientWithBTSQrcode($id);

        return view('list-tasks.data-technical', compact('patient'));
    }
 
    public function fullInterview($id) 
    {
        $patient = $this->patient->findPatientWithBTSQrcode($id);
        $patientHistory = $this->patientHistory->newOrEdit($id);
        $patientRelated = $this->patientRelated->newOrEdit(request()->related_id);
        $patientRelatedList = $this->patientRelated->listByPatient($id);
        $patientFamilyList = $this->patientFamily->listByPatient($id);
        $patientTravelList = $this->patientTravel->listByPatient($id);
        $health_facility = getConmunCode('health_facility');
        $reason_testing = getConmunCode('reason_testing');
        $clinical_symptom = getConmunCode('clinical_symptom');
        $health_history = getConmunCode('health_history');
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
        $family_member = getConmunCode('family_member');
        $interview_status = getPatientCommond($patient->interview_status);
        $interviewStatusList = getConmunCode('status_interview');

        return view('list-tasks.test_full-interview', compact('patient', 'interviewStatusList', 'interview_status', 'health_facility','reason_testing', 'clinical_symptom', 'type_specimen', 'gender', 'lab_center', 'number_sample', 'vaccination', 'type_vaccine', 'covid_patient', 'provinces', 'nation', 'related_patient', 'variant', 'patient', 'patientHistory','patientRelated','patientRelatedList', 'family_member', 'patientFamilyList', 'patientTravelList', 'health_history'));
 
        // return view('list-tasks.full-interview', compact(
        //     'patient',
        //     'patientHistory', 
        //     'patientRelated',
        //     'patientRelatedList',
        // ));
    } 

    public function fullInterviewStore(CreatePatientFullinterviewRequest $request)
    {   
        $patient = $this->patient->fullInterviewStore($request->id,$request->all());
        
        if($patient)
        {
            return redirect(route('list-tasks.fullinterview', $request->id)."#SaveData")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
        }
    } 

    // public function setSearch(Request $request)
    // { 
    //     $patient = $this->patient->setSearch($request->patient_id, 2, $request->basic_note);
        
    //     if($patient)
    //     {
    //         return redirect(route('list-tasks'))->withSuccess(__('FirstInterview')."បានជោគជ័យ");
    //     }
    // }

    
    public function setSearchOrCloseCase(Request $request)
    {   
        if($request->researchorclosecase == 'send_to_ressearch')
        {   
            $patient = $this->patient->setSearch($request->patient_id, 2, $request->close_case, $request->description);
        
            if($patient)
            {
                return redirect(route('list-tasks'));
            }

        } else {

            $patient = $this->patient->closeCase($request->patient_id, $request->all());

            if($patient)
            {
                return redirect(route('list-tasks'));
            }
        }
        
    }

    public function fullInterviewWorkplaceStore(CreateWorkplaceRequest $request)
    {   
    
        $patient = $this->patient->fullInterviewWorkplaceStore($request->id,$request->all());
        if($patient)
        {
            return redirect(route('list-tasks.fullinterview', $request->id)."#PersonWorkLocation")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
        }
    }

    public function patientFamilyStore(CreatePatientFamilyRequest $request)
    {   
        
        if($request->id)
        {

            $update = $this->patientFamily->update($request->id, $request->all());

            if($update)
            {
                return redirect(route('list-tasks.fullinterview', $request->patient_id)."#AffectedFamily")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }

        }else{

            $patientFamily = $this->patient->patientFamilyStore($request->all());

            if($patientFamily)
            {
                return redirect(route('list-tasks.fullinterview', $request->patient_id)."#AffectedFamily")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }
        }

        
    }

    public function editPatientFamily($id)
    {   
        $edit = $this->patientFamily->find($id);

        return response()->json($edit);
    }

    public function deletePatientFamily(Request $request)
    {   
        $id = $request->input('id');
    
        $delete = $this->patientFamily->delete($id);

        if($delete)
        {
            return redirect(route('list-tasks.fullinterview', $request->patient_id)."#familytable")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
        }
    }

    public function patientTravelStore(CreatePatientTravelRequest $request)
    {
        if($request->input('addedit') == 'edit')
        {
            $patientTravel = $this->patientTravel->update($request->input('travel_id'),$request->all());

            if($patientTravel)
            {
                return redirect(route('list-tasks.fullinterview', $request->patient_id)."#patientTravelStore")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }

        }else{

            $patientTravel = $this->patientTravel->create($request->all());

            if($patientTravel)
            {
                return redirect(route('list-tasks.fullinterview', $request->patient_id)."#patientTravelStore")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
            }
        } 

        
    }

    public function deletePatientTravel(Request $request)
    {   
        $id = $request->input('id');
    
        $delete = $this->patientTravel->delete($id);

        if($delete)
        {
            return redirect(route('list-tasks.fullinterview', $request->patient_id)."#traveltable")->withSuccess(__('FirstInterview')."បានជោគជ័យ");
        }
    }

    public function editPatientTravel($id)
    {   
        $edit = $this->patientTravel->find($id);

        return response()->json($edit);
    }

    public function attachFile(Request $request) {
        if($request->hasFile('file_bts')) {
            $bts = $this->attachBtsFile($request);
        }

        if($request->hasFile('file_qrcode')) {
            $qr = $this->attachQrcodeFile($request);
        }

        updateStep($request->patient_id, 3);

        return redirect()->route("list-tasks");
    }

    private function attachBtsFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_bts' => 'required|mimes:xlsx,xsl,csv'
        ]);

        if ($validator->fails()) {
            return redirect()->route('list-tasks')->withSuccess($validator->errors());
        }

        $user_id = Auth::user()->id;
        $current_time = Carbon::now();
        $patient_id = $request->input('patient_id');
        $file_bts = $request->file('file_bts');
        $file_name = $file_bts->getClientOriginalName();    
        $save_path = storage_path('/bts/');
        $file_bts->move($save_path, $file_name);

        $array_excel = Excel::toCollection(new ImportBTSFile, $save_path . $file_name);
        $data_to_insert = [];

        foreach ($array_excel as $values) {
            foreach ($values as $item) {
                if ($item[0] == 'Time') {
                    continue;
                }
                if (is_null($item[0])) {
                    break;
                }

                $time = $item[0];
                $date = $item[1];
                $latlon = explode(',', $item[2]);
                $address = $item[3];

                array_push(
                    $data_to_insert,
                    [
                        'patient_id' => $patient_id,
                        'time' => $time,
                        'date' => $date,
                        'lat' => $latlon[0],
                        'lon' => $latlon[1],
                        'address' => $address,
                        'created_at' => $current_time,
                        'updated_at' => $current_time
                    ]
                );
            }
        }

        if (count($data_to_insert) == 0) {
            return null;
        }

        return $this->attachBts->create($patient_id, $user_id, $data_to_insert);
    }

    private function attachQrcodeFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file_qrcode' => 'required|mimes:xlsx,xsl,csv'
        ]);

        if ($validator->fails()) {
            return redirect()->route('list-tasks')->withSuccess($validator->errors());
        }

        $user_id = Auth::user()->id;
        $current_time = Carbon::now();
        $patient_id = $request->input('patient_id');
        $file_bts = $request->file('file_qrcode');
        $file_name = $file_bts->getClientOriginalName();
        $save_path = storage_path('/qrcode/');
        $file_bts->move($save_path, $file_name);

        $array_excel = Excel::toCollection(new ImportQrcodeFile, $save_path . $file_name);
        $data_to_insert = [];

        foreach ($array_excel as $values) {
            foreach ($values as $item) {
                if ($item[0] == 'ល.រ') {
                    continue;
                }
                if (is_null($item[0])) {
                    break;
                }

                array_push(
                    $data_to_insert,
                    [
                        'patient_id' => $patient_id,
                        'date' => $item[1],
                        'name' => $item[2],
                        'phone' => $item[3],
                        'email' => $item[4],
                        'commune' => $item[5],
                        'district' => $item[6],
                        'province' => $item[7],
                        'result' => $item[8],
                        'created_at' => $current_time,
                        'updated_at' => $current_time
                    ]
                );
            }
        }

        if (count($data_to_insert) == 0) {
            return null;
        }

        return $this->attachQrcode->create($patient_id, $user_id, $data_to_insert);
    }

    public function fullInterviewDone($id)
    {

        $patient = $this->patient->interviewDone($id);
        
        if($patient)
        {
            return redirect(route('list-tasks'))->withSuccess("បានបញ្ចប់ការសម្ភាស៍");
        }
        
    }

    public function showResearch($id)
    {   
        $submit = Patient::find($id);
        $submit->process_by_step5 = auth()->user()->id;
        $submit->save();
        $patient = $this->patient->find($id);
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

        $search_status = '';
        $search_description = '';

        if($patient->source_research == 1){
            
            $search_status = getPatientCommond($patient->basic_to_search_status);
            $search_description = $patient->basic_to_search_description;

        }else{
            $search_status = getPatientCommond($patient->full_to_search_status);
            $search_description = $patient->full_to_search_description;
        }

        return view('list-tasks.research',compact('patient', 'search_status', 'search_description', 'interviewStatusList', 'health_facility','reason_testing', 'clinical_symptom', 'type_specimen', 'gender', 'lab_center', 'number_sample', 'vaccination', 'type_vaccine', 'covid_patient', 'provinces', 'nation', 'related_patient', 'variant'));
    }

}
