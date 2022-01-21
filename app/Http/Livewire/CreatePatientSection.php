<?php

namespace Vanguard\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Vanguard\CommonCode;
use Vanguard\ObjectType;
use Vanguard\Patient;
use Vanguard\Repositories\Patient\PatientRepository;
use Vanguard\Symptom;

class CreatePatientSection extends Component
{
    use WithFileUploads;
    public $health_facility,
        $reason_testing,
        $clinical_symptom,
        $type_specimen,
        $sex,
        $lab_center,
        $number_sample,
        $vaccination,
        $type_vaccine,
        $covid_patient,
        $provinces,
        $nationality,
        $related_patient,
        $variant = [];

    public $districts;

    public $health_facility_id,
        $form_date,
        $form_writer_name,
        $form_writer_phone,
        $test_reason,
        $direct_exposure,
        $exposure_name,
        $exposure_type,
        $name,
        $code,
        $gender,
        $dob,
        $nation_id,
        $phone,
        $address,
        $province,
        $district,
        $commune,
        $village,
        $address_description,
        $symptom_date,
        $was_positive,
        $travel_place,
        $travel_date,
        $travel_no,
        $travel_id,
        $travel_chair,
        $travel_description,
        $virus_type,
        $laboratory_name,
        $laboratory_date,
        $laboratory_id,
        $number_sample_id,
        $first_vaccine,
        $first_vaccine_date,
        $first_vaccine_type_id,
        $second_vaccine,
        $second_vaccine_date,
        $second_vaccine_type_id,
        $third_vaccine,
        $third_vaccine_date,
        $third_vaccine_type_id,
        $laboratory_collector,
        $laboratory_collector_phone,
        $laboratory_file;

    public $clinical_symtom,$object_types_id = [];

    protected $rules = [
        'form_date' => 'required',
        'name' => 'required',
        'phone' => 'required',
        'laboratory_name' => 'required',
        'laboratory_date' => 'required',
    ];

    protected $messages = [
        'form_date.required' => 'សូមបញ្ចូល កាលបរិច្ឆេទ',
        'name.required' => 'សូមបញ្ចូល ឈ្មោះអ្នកជំងឺ',
        'phone.required' => 'សូមបញ្ចូល លេខទូរស័ព្ទ',
        'laboratory_name.required' => 'សូមបញ្ចូល ទីកន្លែងប្រមូលវត្ថុវិភាគ',
        'laboratory_date.required' => 'សូមបញ្ចូល ថ្ងៃយកវត្ថុសំណាក',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $health_facility = CommonCode::commonCode('health_facility')->first();
        $reason_testing = CommonCode::commonCode('reason_testing')->first();
        $clinical_symptom = CommonCode::commonCode('clinical_symptom')->first();
        $type_specimen = CommonCode::commonCode('type_specimen')->first();
        $gender = CommonCode::commonCode('gender')->first();
        $lab_center = CommonCode::commonCode('lab_center')->first();
        $number_sample = CommonCode::commonCode('number_sample')->first();
        $vaccination = CommonCode::commonCode('vaccination')->first();
        $type_vaccine = CommonCode::commonCode('type_vaccine')->first();
        $covid_patient = CommonCode::commonCode('covid_patient')->first();
        $nation = CommonCode::commonCode('nation')->first();
        $related_patient = CommonCode::commonCode('related_patient')->first();
        $variant = CommonCode::commonCode('variant')->first();

        $this->health_facility = $health_facility->children;
        $this->reason_testing = $reason_testing->children;
        $this->clinical_symptom = $clinical_symptom->children;
        $this->type_specimen = $type_specimen->children;
        $this->sex = $gender->children;
        $this->lab_center = $lab_center->children;
        $this->number_sample = $number_sample->children;
        $this->vaccination = $vaccination->children;
        $this->type_vaccine = $type_vaccine->children;
        $this->covid_patient = $covid_patient->children;
        $this->nationality = $nation->children;
        $this->related_patient = $related_patient->children;
        $this->variant = $variant->children;
        $this->provinces = getLocationCode('province');
    }
    public function render()
    {
        return view('livewire.create-patient-section');
    }

    public function selectProvince()
    {
//        dd($this->province);
//        $this->districts =
    }
    public function savePatient()
    {

        $code = '';
        $rowDate = Carbon::now();
        $date = $rowDate->format('d m Y');
        $dateSpite = explode(" ", $date);
        if($this->name)
        {
            $nameSpit = explode(" ", $this->name);
            $count = Patient::count();
            if(!preg_match('/[^A-Za-z0-9]/', $this->name))
            {
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper((substr($nameSpit[0], -1).substr($nameSpit[1], -1))).($count + 1);
            }else{
                $keyName = getKeyName(substr($nameSpit[0], -1),substr($nameSpit[1], -1));
                $code = substr($dateSpite[2], 2).$dateSpite[1].$dateSpite[0].strtoupper($keyName).($count + 1);
            }
        }
//       $data = $this->validate();
        dd($this->form_date);

        $patient = new Patient();
        $patient->health_facility_id = $this->health_facility_id;
        $patient->form_date = $this->form_date;
        $patient->form_writer_name = $this->form_writer_name;
        $patient->form_writer_phone = $this->form_writer_phone;
        $patient->test_reason = $this->test_reason;
        $patient->direct_exposure = $this->direct_exposure;
        $patient->exposure_name = $this->exposure_name;
        $patient->exposure_type = $this->exposure_type;
        $patient->name = $this->name;
        $patient->code = $code;
        $patient->gender = $this->gender;
        $patient->dob = $this->dob;
        $patient->nation_id = $this->nation_id;
        $patient->phone = $this->phone;
        $patient->address = $this->address;
        $patient->province = $this->province;
        $patient->district = $this->district;
        $patient->commune = $this->commune;
        $patient->village = $this->village;
        $patient->address_description = $this->address_description;
        $patient->symptom_date = $this->symptom_date;
        $patient->was_positive = $this->was_positive;
        $patient->travel_place = $this->travel_place;
        $patient->travel_date = $this->travel_date;
        $patient->travel_date = $this->travel_date;
        $patient->travel_no = $this->travel_no;
        $patient->travel_no = $this->travel_no;
        $patient->travel_id = $this->travel_id;
        $patient->travel_chair = $this->travel_chair;
        $patient->travel_description = $this->travel_description;
        $patient->virus_type = $this->virus_type;
        $patient->laboratory_name = $this->laboratory_name;
        $patient->laboratory_date = $this->laboratory_date;
        $patient->laboratory_id = $this->laboratory_id;
        $patient->number_sample = $this->number_sample_id;
        $patient->first_vaccine = $this->first_vaccine;
        $patient->first_vaccine_date = $this->first_vaccine_date;
        $patient->first_vaccine_type_id = $this->first_vaccine_type_id;
        $patient->second_vaccine = $this->second_vaccine;
        $patient->second_vaccine_date = $this->second_vaccine_date;
        $patient->second_vaccine_type_id = $this->second_vaccine_type_id;
        $patient->third_vaccine = $this->third_vaccine;
        $patient->third_vaccine_date = $this->third_vaccine_date;
        $patient->third_vaccine_type_id = $this->third_vaccine_type_id;
        $patient->laboratory_collector = $this->laboratory_collector;
        $patient->laboratory_collector_phone = $this->laboratory_collector_phone;
        $patient->laboratory_file = $this->laboratory_file;
        $patient->save();

        if(isset($this->object_types_id)){
            foreach ($this->object_types_id as $item)
            {
                $symptom =new ObjectType();
                $symptom->object_type_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();

            }
        }
        if(isset($this->symptom_id)){
            foreach ($this->symptom_id as $item)
            {
                $symptom =new Symptom();
                $symptom->symptom_id = $item;
                $symptom->patient_id = $patient->id;
                $symptom->save();
            }
        }

        return redirect(route('interview',['id'=>$patient->id]));
    }
}
