<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'was_positive',
        'cured_place',
        'injection_source',
        'test_date',
        'test_reason',
        'test_place',
        'test_result',
        'result_date',
        'symptoms',
        'symptoms_date',
    ];
}
