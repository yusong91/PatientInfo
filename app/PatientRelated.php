<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRelated extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'name',
        'gender',
        'age',
        'phone',
        'last_date',
        'risk_level',
        'address',
        'job',
        'note',
        'result'
    ];

    public function risk() {
        return $this->belongsTo(CommonCode::class, 'risk_level', 'id');
    }

    public function sex(){
        return $this->belongsTo(CommonCode::class,'gender','id');
    }
}

