<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;
use Vanguard\CommonCode;
use Carbon\Carbon;
use Vanguard\Exports\PatientExport;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Http\Requests\Patient\CreatePatientRequest;
use Vanguard\Patient;
use Vanguard\Repositories\CommonCode\CommonCodeRepository;
use Vanguard\Repositories\Patient\PatientRepository;
use Vanguard\Model\ExcelPatient;
use PDF;
use Vanguard\User;
use DB;
use Illuminate\Support\Facades\Cache;

class PatientsController extends Controller
{
    private $patient;
    private $health_facility;
    private $reason_testing;
    private $clinical_symptom;
    private $type_specimen;
    private $gender;
    private $lab_center;
    private $number_sample;
    private $vaccination;
    private $type_vaccine;
    private $covid_patient;
    private $nation;
    private $related_patient;
    private $variant;
    private $provinces;
    private $districts; 
    
	public function __construct(PatientRepository $patient,CommonCodeRepository $commouneCode)
    { 
		$this->patient = $patient;
	}
 
    public function index(Request $request){

		$patients = $this->patient->paginatePatient(
            $perPage = 10,
            $request->search,
            null
        ); 
        
		$raw_paginate = json_encode($patients);
        $paginate = json_decode($raw_paginate);
		return view('patients.index',compact('patients', 'paginate'));
	} 
 
	public function create()
	{
        $this->health_facility = CommonCode::commonCode('health_facility')->first()->children;
        $this->reason_testing = CommonCode::commonCode('reason_testing')->first()->children;
        $this->clinical_symptom = CommonCode::commonCode('clinical_symptom')->first()->children;
        $this->type_specimen = CommonCode::commonCode('type_specimen')->first()->children;
        $this->gender = CommonCode::commonCode('gender')->first()->children;
        $this->lab_center = CommonCode::commonCode('lab_center')->first()->children;
        $this->number_sample = CommonCode::commonCode('number_sample')->first()->children;
        $this->vaccination = CommonCode::commonCode('vaccination')->first()->children;
        $this->type_vaccine = CommonCode::commonCode('type_vaccine')->first()->children;
        $this->covid_patient = CommonCode::commonCode('covid_patient')->first()->children;
        $this->nation = CommonCode::commonCode('nation')->first()->children;
        $this->related_patient = CommonCode::commonCode('related_patient')->first()->children;
        $this->variant = CommonCode::commonCode('variant')->first()->children;
        $this->provinces = getLocationCode('province');
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;//CommonCode::commonCode('vaccination')->get();

        //Cache::forget('key');

        $key_input = Cache::get("old_data");

        if($key_input == null){
            $key_input = ['laboratory_name'=>null, 'health_facility'=>null, 'health_facility_date'=>null, 'form_writer_name'=>null, 'form_writer_phone'=>null, 'gender'=>null, 'positive_date'=>null, 'province'=>null, 'district'=>null, 'commune'=>null, 'village'=>null, 'was_positive'=>null, 'labform_province'=>null, 'laboratory_id'=>null, 'laboratory_date'=>null, 'number_sample_id'=>null, 'object_types_id'=>null, 'laboratory_collector'=>null, 'laboratory_collector_phone'=>null];
        } 

		return view('patients.create',[
            'vaccination_list'=>$vaccination_list,
            'key_input'=>$key_input,
            'health_facility'=>$this->health_facility,
            'reason_testing'=>$this->reason_testing,
            'clinical_symptom'=>$this->clinical_symptom,
            'type_specimen'=>$this->type_specimen,
            'gender'=>$this->gender,
            'lab_center'=>$this->lab_center,
            'number_sample'=>$this->number_sample,
            'vaccination'=>$this->vaccination,
            'type_vaccine'=>$this->type_vaccine,
            'covid_patient'=>$this->covid_patient,
            'nation'=>$this->nation,
            'related_patient'=>$this->related_patient,
            'variant'=>$this->variant,
            'provinces'=>$this->provinces,
            'districts'=>$this->districts
        ]); 
	}
   
	public function store(CreatePatientRequest $request)
	{   
        //dd($request->all());

        $key = ['name'=>$request->input('name'), 'phone'=>$request->input('phone'), 'gender'=>$request->input('gender')];
        
        $duplicate = $this->patient->checkDuplicate($key);
        
        if($duplicate)
        {
            return redirect(route('patients'))->withSuccess("ទិន្នន័យស្ទួន!");
        }

        $health_facility = $request->health_facility_id;
        $health_facility_date = $request->form_date;
        $form_writer_name = $request->form_writer_name;
        $form_writer_phone = $request->form_writer_phone;
        $gender = $request->gender;
        $positive_date = $request->positive_date; 
        $province = $request->province;
        $district = $request->district;
        $commune = $request->commune;
        $village = $request->village;
        $was_positive = $request->was_positive;
        $labform_province = $request->labform_province;
        $laboratory_name = $request->laboratory_name;
        $laboratory_date = $request->laboratory_date;
        $laboratory_id = $request->laboratory_id;
        $number_sample_id = $request->number_sample_id;
        $object_types_id = $request->object_types_id;
        $laboratory_collector = $request->laboratory_collector;
        $laboratory_collector_phone = $request->laboratory_collector_phone;

        $key_input = ['health_facility'=>$health_facility, 'health_facility_date'=>$health_facility_date, 'form_writer_name'=>$form_writer_name, 'form_writer_phone'=>$form_writer_phone, 'gender'=>$gender, 'positive_date'=>$positive_date, 'province'=>$province, 'district'=>$district, 'commune'=>$commune, 'village'=>$village, 'was_positive'=>$was_positive, 'labform_province'=>$labform_province, 'laboratory_name'=>$laboratory_name, 'laboratory_id'=>$laboratory_id, 'laboratory_date'=>$laboratory_date, 'number_sample_id'=>$number_sample_id, 'object_types_id'=>$object_types_id, 'laboratory_collector'=>$laboratory_collector, 'laboratory_collector_phone'=>$laboratory_collector_phone];
         
        Cache::put('old_data', $key_input, now()->addMinutes(10));

        $patient = $this->patient->create($request->all());

        if($patient){
            
            return redirect(route('patients.create'))->withSuccess("បង្កើតបានជោគជ័យ");
        }
	} 
 
    public function edit($id)
    {
        $edit = $this->patient->find($id);
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
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        $patient_vaccine = getPatientVaccine($id);

        //dd([$vaccination_list, $patient_vaccine]);

        return view('patients.edit', compact('edit', 'patient_vaccine', 'vaccination_list','health_facility','reason_testing', 'clinical_symptom', 'type_specimen', 'gender', 'lab_center', 'number_sample', 'vaccination', 'type_vaccine', 'covid_patient', 'provinces', 'nation', 'related_patient', 'variant'));
    }

    public function update(CreatePatientRequest $request)
    {
        $patient = $this->patient->update($request->id,$request->all());
        if($patient)
        {
            return redirect(route('patients'))->withSuccess("កែប្រែបានជោគជ័យ");
        }
    }
 
    public function delete($id)
    {
        $status = $this->patient->delete($id);
        if($status)
        {
            return redirect('patients')->withSuccess(__('ការលុបបានជោគជ័យ'));
        }
    }

	public function storeExcel(Request $request)
	{
		$file = $request->file('lab_form');
        $file_name = $file->getClientOriginalName();
        $save_path = storage_path('labform');
        $file->move($save_path, $file_name);

        $array_excel = Excel::toCollection(new ExcelPatient, $save_path . '/' . $file_name);

        foreach ($array_excel as $values) {

            for ($i=4; $i < count($values); $i++) { 
            
                $patientCode = $values[$i][0];
                $patientName = $values[$i][1];
                $patientGender = $values[$i][2];
                $patientNationality = $values[$i][3];
                $patientAge = $values[$i][4];
                $patientDob = $values[$i][5];
                $patientLabformCode = $values[$i][6];
                $patientPhone = $values[$i][7];
                $patientPasspor = $values[$i][8];
                $patientCommune = $values[$i][14];
                $patientDistrict = $values[$i][15];
                $patientProvince = $values[$i][16];
                $patientCareer  = $values[$i][17];


               return $patientCareer;
            }
        }

	}
    
    //View Superior
    public function report(){
        
        $now = Carbon::now()->toDateString();

        $dataentry = Patient::where('step1','!=',null)->where('created_at','>=', $now)->count();
        $basic = Patient::where('step2','!=',null)->where('created_at','>=', $now)->count();
        $datatechnical = Patient::where('step3','!=',null)->where('created_at','>=', $now)->count();
        $fullinterview = Patient::where('step4','!=',null)->where('created_at','>=', $now)->count();
        $death = Patient::where('death',"on")->count();
        $research = 0;

        $fullUser = User::where('parent_id',auth()->user()->id)->get();
        
        $ids = User::where('parent_id',auth()->user()->id)->pluck('id');
        
        foreach ($fullUser as $item){
            $item->countData = Patient::where('step4',$item->id)->count();
        }
        
        $patients = Patient::whereIn('step1',$ids)->orwhereIn('step2',$ids)->orwhereIn('step3',$ids)->orwhereIn('step4',$ids)->paginate(10);
        
        return view('patients.superior',compact('patients','fullUser', 'dataentry', 'basic', 'datatechnical', 'fullinterview'));
    }

    public function settingReport(){ 

        // alpha 280, beta 281, gamma 282, delta 283
        $patient_all = Patient::count(); 
        $patient_daily = Patient::whereDate('created_at', Carbon::today())->count();
        $patient_death_all = Patient::where('death','!=', 'off')->count();
        $patient_death_daily = Patient::where('death','!=', 'off')->whereDate('created_at', Carbon::today())->count();

        $currentDateTime = Carbon::now(); 
        $currentDate = Carbon::parse($currentDateTime);
        $past_day_1 = Carbon::parse($currentDateTime)->subDays(1);
        $past_day_2 = Carbon::parse($currentDateTime)->subDays(2);
        $past_day_3 = Carbon::parse($currentDateTime)->subDays(3);
        $list_variants = ['Year-Month-Day'];
        $variants = CommonCode::commonCode('variant')->first()->children;
        
        $data_past_day_0 = Patient::whereDate('created_at', $currentDate->format('Y-m-d'))->get()->groupBy('virus_type');
        $data_past_day_1 = Patient::whereDate('created_at', $past_day_1->format('Y-m-d'))->get()->groupBy('virus_type');
        $data_past_day_2 = Patient::whereDate('created_at', $past_day_2->format('Y-m-d'))->get()->groupBy('virus_type');
        $data_past_day_3 = Patient::whereDate('created_at', $past_day_3->format('Y-m-d'))->get()->groupBy('virus_type');
        
        $data_bar_chart_past_day_0 = [['',''],['','']];
        $data_bar_chart_past_day_1 = [$past_day_1->format('Y-m-d')];
        $data_bar_chart_past_day_2 = [$past_day_2->format('Y-m-d')];
        $data_bar_chart_past_day_3 = [$past_day_3->format('Y-m-d')];

        foreach($variants as $item)
        {
            if(isset($data_past_day_0[$item->id]))
            {
                $data_bar_chart_past_day_0[] = [$item->value, count($data_past_day_0[$item->id])];
            }else{
                $data_bar_chart_past_day_0[] = [$item->value, 0];
            }
        }

        //dd($data_bar_chart_past_day_0);
        
        foreach($variants as $item)
        {
            if(isset($data_past_day_1[$item->id]))
            {
                $data_bar_chart_past_day_1[] = count($data_past_day_1[$item->id]);
            }else{
                $data_bar_chart_past_day_1[] = 0;
            }
        }

        foreach($variants as $item)
        {
            if(isset($data_past_day_2[$item->id]))
            {
                $data_bar_chart_past_day_2[] = count($data_past_day_2[$item->id]);
            }else{
                $data_bar_chart_past_day_2[] = 0;
            }
        }

        foreach($variants as $item)
        {
            if(isset($data_past_day_3[$item->id]))
            {
                $data_bar_chart_past_day_3[] = count($data_past_day_3[$item->id]);
            }else{
                $data_bar_chart_past_day_3[] = 0;
            }
        }

        $data_bar_chart_past_day_all = [$data_bar_chart_past_day_3, $data_bar_chart_past_day_2, $data_bar_chart_past_day_1];

       
       foreach($variants as $variant)
       {
           $list_variants[] = $variant->value;
       }
       
        //dd($data_bar_chart_past_day_all[2]);

        return view('report.general-report',compact('data_bar_chart_past_day_0', 'patient_all', 'list_variants', 'patient_daily', 'patient_death_all', 'patient_death_daily', 'data_bar_chart_past_day_all'));
    } 

    public function approveFullInterivew($patient_id)
    {   
        $interviewStatusList = getConmunCode('status_interview');

        $patient = Patient::where('id',$patient_id)->with([
            'sex', 'nation', 'symptom', 'objectTypes', 'hospital',
            'related', 'family'
        ])->first(); 

        $family_member = getConmunCode('family_member');

        $clinical_symptom = getConmunCode('clinical_symptom');

        $patient_family = getPatientFamily($patient->id);

        $patient_related = getPatientRelated($patient->id);

        $patient_travel = getPatientTravel($patient->id);

        $health_history = getConmunCode('health_history');

        $variant = getPatientCommond($patient->virus_type);

        $test_reason = getPatientCommond($patient->test_reason);

        $health_facility = getPatientCommond($patient->health_facility_id);

        $was_positive = getPatientCommond($patient->was_positive);

        $gender = getPatientCommond($patient->gender);

        $nation = getPatientCommond($patient->nation_id);

        $kind_first_vaccine = getPatientCommond($patient->first_vaccine_type_id);

        $kind_second_vaccine = getPatientCommond($patient->second_vaccine_type_id);

        $kind_third_vaccine = getPatientCommond($patient->third_vaccine_type_id);

        $province = getLocationCodeAddress($patient->province);

        $district = getLocationCodeAddress($patient->district);

        $commune = getLocationCodeAddress($patient->commune);

        $village = getLocationCodeAddress($patient->village);
                 
        return view('patients.approve-fullinterview', compact('patient','province','district','commune','village','family_member','interviewStatusList', 'kind_third_vaccine', 'kind_second_vaccine', 'kind_first_vaccine', 'nation', 'gender', 'clinical_symptom', 'patient_family', 'patient_related', 'patient_travel', 'health_history', 'variant', 'test_reason', 'health_facility', 'was_positive'));
    }

    //Superior finish full interview 
    public function finishInterview(Request $request)
    {   
        $finished = $this->patient->superiorFinish($request->patient_id);

        if($finished)
        {
            return redirect('patientReport');
        }
    }

    //send from superior to full interview again to complete patient info
    public function interviewAgain(Request $request)
    {
        $interview = $this->patient->fullInterviewAgain($request->all());

        if($interview)
        {
            return redirect('patientReport');
        }
    }

}
