<?php

namespace Vanguard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTravel extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'location_name', 'time', 'date', 'address'];

    protected $table = "patient_travel_historys";


}