<?php

namespace Vanguard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_facility_id',
        'form_date',
        'form_writer_name',
        'form_writer_phone',
        'test_reason',
        'exposure_name',
        'exposure_type',
        'name',
        'gender',
        'dob',
        'nation_id',
        'phone',
        'address',
        'province',
        'district',
        'commune',
        'village',
       // 'address_code',
        'was_positive',
        'travel_place',
        'travel_date',
        'travel_no',
        'travel_id',
        'travel_chair',
        'travel_description',
        'laboratory_name',
        'laboratory_date',
        'laboratory_id',
    //    'object_types_id',
        'first_vaccine',
        'first_vaccine_date',
        'first_vaccine_type_id',
        'second_vaccine',
        'second_vaccine_date',
        'second_vaccine_type_id',
        'third_vaccine',
        'third_vaccine_date',
        'third_vaccine_type_id',
        'laboratory_collector',
        'laboratory_collector_phone',
 //       'laboratory_file'
        'positive_date',
        'job',
        'patient_age',
        'workplace_phone',
        'workplace_amount_staff',
        'workplace_address',
        'real_name',
        'real_dob',
        'real_phone',
        'death',
        'labform_province',
        'second_phone',
        'basic_note',
        'basic_message',
        'source_research'
    ];

    public function symptom(){
        return $this->hasMany(Symptom::class);
    }

    public function health(){
        return $this->hasMany(Health::class);
    }

    public function objectTypes(){
        return $this->hasMany(ObjectType::class); 
    }

    public function hospital(){
        return $this->belongsTo(CommonCode::class,'health_facility_id','id');
    }

    public function sex(){
        return $this->belongsTo(CommonCode::class,'gender','id');
    }

    public function nation(){
        return $this->belongsTo(CommonCode::class,'nation_id','id');
    }

    public function related() {
        return $this->hasMany(PatientRelated::class);
    }

    public function family() {
        return $this->hasMany(PatientFamily::class);
    }

    public function getAgeAttribute() {
        return $this->dob ? Carbon::parse($this->dob)->diff(Carbon::now())->y : null;
    }
 
    public function getProvince(){
        return $this->belongsTo(LocationCode::class,'province','code');
    }

    public function getAttachBts(){

        return $this->hasMany(AttachBts::class,'patient_id');
    }

    public function getAttachQrCode(){

        return $this->hasMany(AttachQrcode::class,'patient_id');
    }

    public function getVaccineDescriptionAttribute() {
        $description = "";

        $firstDescription = "";
        $first = $this->first_vaccine == 1;
        if($first) {
            $firstDate = getDateFormat($this->first_vaccine_date);
            $firstType = $this->first_vaccine_type_id->value ?? "";
            $firstDescription = "លើកទី១ $firstDate $firstType  ";
        }

        $secondDescription = "";
        $second = $this->second_vaccine == 1;
        if($second) {
            $secondDate = getDateFormat($this->second_vaccine_date);
            $secondType = $this->second_vaccine_type_id->value ?? "";
            $secondDescription = "លើកទី២ $secondDate $secondType  ";
        }

        $thirdDescription = "";
        $third = $this->third_vaccine == 1;
        if($third) {
            $thirdDate = getDateFormat($this->third_vaccine_date);
            $thirdType = $this->third_vaccine_type_id->value ?? "";
            $thirdDescription = "លើកទី៣ $thirdDate $thirdType  ";
        }

        $description = "$firstDescription $secondDescription $thirdDescription";

        return $description;
    }

}
