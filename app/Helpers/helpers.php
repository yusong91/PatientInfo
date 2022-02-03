<?php

use Carbon\Carbon;
use Vanguard\KhDate;
use Vanguard\CommonCode;
use Google\Cloud\Storage\StorageClient;


if(!function_exists('getConmunCode')){
    function getConmunCode($key){
        $communCode = \Vanguard\CommonCode::where('key',$key)->with('children')->first();
        return $communCode->children;
    }
}

if(!function_exists('getPatientVaccine')){
    function getPatientVaccine($patient_id){
        $patient_vaccine = \Vanguard\Vaccine::where('patient_id',$patient_id)->get();
        return $patient_vaccine;
    }
}

if(!function_exists('getSymptom')){
    function getSymptom($id,$data){
        foreach ($data as $item){
            if($item->symptom_id==$id){
                return 'checked';
            }
        }
    }
}

if(!function_exists('getSymptomReport')){
    function getSymptomReport($id,$data){
        foreach ($data as $item){
            if($item->symptom_id==$id){
                return true;
            }
        }
    }
}
 
if(!function_exists('getHealthReport')){
    function getHealthReport($id,$data){
        foreach ($data as $item){
            if($item->health_id==$id){
                return true;
            }
        }
    }
}

if(!function_exists('getPatientFamily')){
    function getPatientFamily($patient_id){
        $patient_family = \Vanguard\PatientFamily::where('patient_id',$patient_id)->get();
        return $patient_family;
    }
}

if(!function_exists('getPatientRelated')){
    function getPatientRelated($patient_id){
        $patient_related = \Vanguard\PatientRelated::where('patient_id',$patient_id)->get();
        return $patient_related;
    }
}

if(!function_exists('getPatientTravel')){
    function getPatientTravel($patient_id){
        $patient_travel = \Vanguard\PatientTravel::where('patient_id',$patient_id)->get();
        return $patient_travel;
    }
}

if(!function_exists('getHealth')){
    function getHealth($id,$data){
        foreach ($data as $item){
            if($item->health_id==$id){
                return 'checked';
            }
        }
    }
}

if(!function_exists('getObjectTypes')){
    function getObjectTypes($id,$data){
        foreach ($data as $item){
            if($item->object_type_id==$id){
                return 'checked';
            }
        }
    }
}

if(!function_exists('getProvince')){
    function getProvince($key,$type){
        $provinceCode = \Vanguard\LocationCode::where(['code'=>$key,'type'=>$type])->first();
        if($provinceCode){
            return $provinceCode->name;
        }
        return ""; 
    }
} 

if(!function_exists('getLocationCode')){
    function getLocationCode($type){
        $provinceCode = \Vanguard\LocationCode::where('type',$type)->get();
        return $provinceCode;
    } 
}

if(!function_exists('getLocationCodeAddress')){
    function getLocationCodeAddress($id){
        $locationCode = \Vanguard\LocationCode::where('code',$id)->first();
        return $locationCode;
    } 
}

if(!function_exists('downloadPatientReport')){
    function downloadPatientReport($id){

        $patient = \Vanguard\Patient::where('id',$id)->with([
            'sex', 'nation', 'symptom', 'objectTypes', 'hospital',
            'related', 'family'
        ])->first(); 

        $interviewStatusList = getConmunCode('status_interview');
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
        $province = getLocationCodeAddress($patient->province);
        $district = getLocationCodeAddress($patient->district);
        $commune = getLocationCodeAddress($patient->commune);
        $village = getLocationCodeAddress($patient->village); 
        $vaccination_list = CommonCode::commonCode('number_vaccination')->first()->children;
        $patient_vaccine = getPatientVaccine($id);  
        $type_vaccine = CommonCode::commonCode('type_vaccine')->first()->children;

        $pdfViewer = view('pdf.patientPdfReport', ['type_vaccine'=>$type_vaccine, 'vaccination_list'=>$vaccination_list, 'patient_vaccine'=>$patient_vaccine, 'patient'=>$patient, 'province'=>$province, 'district'=>$district, 'commune'=>$commune, 'village'=>$village, 'family_member'=>$family_member, 'interviewStatusList'=>$interviewStatusList, 'nation'=>$nation, 'gender'=>$gender, 'clinical_symptom'=>$clinical_symptom, 'patient_family'=>$patient_family, 'patient_related'=>$patient_related, 'patient_travel'=>$patient_travel, 'health_history'=>$health_history, 'variant'=>$variant, 'test_reason'=>$test_reason, 'health_facility'=>$health_facility, 'was_positive'=>$was_positive]);
   
        $options = ['gs' => ['acl' => 'public-wite']];
        $context = stream_context_create($options);
        $fileName = "public_file.pdf";

        $data = ['type_vaccine'=>$type_vaccine, 'vaccination_list'=>$vaccination_list, 'patient_vaccine'=>$patient_vaccine, 'patient'=>$patient, 'province'=>$province, 'district'=>$district, 'commune'=>$commune, 'village'=>$village, 'family_member'=>$family_member, 'interviewStatusList'=>$interviewStatusList, 'nation'=>$nation, 'gender'=>$gender, 'clinical_symptom'=>$clinical_symptom, 'patient_family'=>$patient_family, 'patient_related'=>$patient_related, 'patient_travel'=>$patient_travel, 'health_history'=>$health_history, 'variant'=>$variant, 'test_reason'=>$test_reason, 'health_facility'=>$health_facility, 'was_positive'=>$was_positive];

        $storage = new StorageClient();
        
        $bucket = $storage->bucket('patientcovid_bucket');

        $storage = new StorageClient();

        $test = PDF::loadHtml($pdfViewer);

        $pdf = App::make('dompdf.wrapper');
        
        //$pdf->loadView('pdf.patientPdfReport', $data);
        $pdf->loadHtml($pdfViewer);

        $bucket->upload($pdf->output(), [
            'predefinedAcl' => 'publicRead',
            'name' => 'report/test1.pdf'
          ]);




    }      
}

if(!function_exists('translateCommonCode')){
    function translateCommonCode($id){
    
        $code = \Vanguard\CommonCode::where('id', $id)->first();

        if(isset($code->value))
        {
            return $code->value;
        }
        return null;
    }
}

if(!function_exists('getPatientCommond')){
    function getPatientCommond($id){
        $patient_commond = \Vanguard\CommonCode::where('id',$id)->first();
        return $patient_commond;
    }
}

if(!function_exists('getKeyName')){
    function getKeyName($firstName, $lastName){
        $keyName = array(
            'ក'=>'K',
            'ខ'=>'K',
            'គ'=>'K',
            'ឃ'=>'K',
            'ង'=>'G',
            'ច'=>'C',
            'ឆ'=>'C',
            'ជ'=>'C',
            'ឈ'=>'C',
            'ញ'=>'N',
            'ដ'=>'D',
            'ឋ'=>'T',
            'ឌ'=>'D',
            'ឍ'=>'T',
            'ណ'=>'N',
            'ត'=>'T',
            'ថ'=>'T',
            'ទ'=>'T',
            'ធ'=>'T',
            'ន'=>'N',
            'ប'=>'B',
            'ផ'=>'P',
            'ព'=>'P',
            'ភ'=>'P',
            'ម'=>'M',
            'យ'=>'Y',
            'រ'=>'R',
            'ល'=>'L',
            'វ'=>'V',
            'ស'=>'S',
            'ហ'=>'H',
            'ឡ'=>'I',
            'អ'=>'Z',
            'K'=>'K',
            'G'=>'G',
            'C'=>'C',
            'N'=>'N',
            'D'=>'D',
            'T'=>'T',
            'B'=>'B',
            'P'=>'P',
            'M'=>'M',
            'Y'=>'Y',
            'R'=>'R',
            'L'=>'L',
            'V'=>'V',
            'S'=>'S',
            'H'=>'H',
            'I'=>'L',
            'Z'=>'Z'
        );

        if(!isset($keyName[$firstName]) || !isset($keyName[$lastName])){

            return 'AA';
        } 

        return $keyName[strtoupper($firstName)] . $keyName[strtoupper($lastName)];
    }

    if(!function_exists('getLabelDistrict')){
        function getLabelDistrict($code){
            if($code==null) return "";
            $districtCode = \Vanguard\LocationCode::where(['type'=>'district','code'=>$code])->first();
            if($districtCode==null){
                return  "";
            }
            return $districtCode->name_kh??"";
        }
    }
    if(!function_exists('getLabelCommune')){
        function getLabelCommune($code){
            if($code==null) return "";
            $districtCode = \Vanguard\LocationCode::where(['type'=>'commune','code'=>$code])->first();
            if($districtCode==null){
                return  "";
            }
            return $districtCode->name_kh??"";
        }
    }

    if(!function_exists('getLabelVillage')){
        function getLabelVillage($code){
            if($code==null) return "";
            $districtCode = \Vanguard\LocationCode::where(['type'=>'village','code'=>$code])->first();
            if($districtCode==null){
                return  "";
            }
            return $districtCode->name_kh??"";
        }
    }

    if(!function_exists('getUrl')){
        function getUrl($path){
            $districtCode = "https://storage.googleapis.com/patientcovid_bucket/" . $path;
            return $districtCode;
        }
    }

    if(!function_exists('getTextStatus')){
        function getTextStatus($statu_message, $research = null){
            
            if($statu_message == 1)
            {
                return "ទើបបញ្ចូលហើយ";
                
            }elseif($statu_message == 2)
            {
                return "ទើបសម្ភាស៍បឋមហើយ";
            } 
            elseif($statu_message == 3)
            {
                return "ទើបដាក់ទីតាំងហើយ";
            }
            elseif($statu_message == 4)
            {
                return "ទើបសម្ភាស៍ពេញហើយ";
            }
            elseif($statu_message == 5)
            {
                return "ស្រាវជ្រាវ";
            }
            elseif($statu_message == 6)
            {
                return "ទើបស្រាវជ្រាវហើយ"; 
            }
            elseif($statu_message == 7)
            {
                return "ត្រូវសម្ភាស៍ពេញបន្ថែម";
            }
            elseif($statu_message == 8)
            {
                return "រួចរាល់";
            }
            elseif($statu_message == 9)
            {
                return "បិទបញ្ចប់ករណី";
            }
        }
    }
 
    if(!function_exists('getTextColor')){
        function getTextColor($status){
            if($status==1){
                return "badge-dark";
            }elseif($status==2){
                return "badge-info";
            }elseif($status==3){
                return "badge-warning";
            }elseif($status==4){
                return "badge-primary";
            }elseif($status==5){
                return "badge-danger";
            }
            elseif($status==9){
                return "badge-danger";
            }else{
                return "badge-success";
            }
        }
    }

    if(!function_exists('getTextUserRole')){
        function getTextUserRole($user){
            if($user == 1){
                return ['2', 'សម្ភាស៍បឋម'];
            } elseif($user == 2){
                return ['4', 'សម្ភាស៍ពេញ'];
            }
        }
    }

    if(!function_exists('getDateFormat')){
        function getDateFormat($date){
            if($date==null) {
                return "";
            }
            return date('d/m/Y',strtotime($date));
        }
    }

    if(!function_exists('toDatabaseDateFormat')){
        function toDatabaseDateFormat($date){
            if($date==null) {
                return null;
            }

            $date = str_replace('/', '-', $date);
            $dateFormat = date('Y-m-d', strtotime($date));

            return $dateFormat;
        }
    }

    if(!function_exists('getCurrentRouteName')){
        function getCurrentRouteName(){
            return request()->route()->getName();
        }
    }

    if(!function_exists('updateStep')){
        function updateStep($patientId, $step){
            $user_id = auth()->user()->id;
            DB::table('patients')->where('id', $patientId)->update([
                "step$step" => $user_id,
                "status" => $step,
                "status_message" => 3,
            ]);
        }
    }

    if (!function_exists('getKhChankitek')) {
        function getKhChankitek()
        {
            $date = Carbon::now()->format('Y-m-d');
            $query = KhDate::where('en_date', $date)->first();
            $reserved = KhDate::first();
            return $query ? $query : $reserved;
        }
    }

    if (!function_exists('getCurrentDate')) {
        function getCurrentDate()
        {
            return Carbon::now()->format('Y-m-d');
        }
    }

}
