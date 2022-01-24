<?php

namespace Vanguard;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'number_vaccine', 'vaccine_type_id', 'date'];

    protected $table = "vaccines";

}