<?php

namespace Vanguard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFamily extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'name', 'gender', 'person_age', 'phone', 'last_touch_date', 'test_result', 'family_member', 'note', 'second_phone'];

    protected $table = "patient_familys";

    public function sex(){
        return $this->belongsTo(CommonCode::class,'gender','id');
    }

    public function result(){
        return $this->belongsTo(CommonCode::class,'test_result','id');
    }


}