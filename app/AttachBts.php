<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class AttachBts extends Model
{
    use HasFactory;

    protected $table = 'patients_bts';

    protected $fillable = ['patient_id', 'time', 'date', 'lat', 'lon', 'address'];

    public function patientIsParent(){    
  
        return $this->belongsTo('Vanguard\Patient','patient_id'); 
    }
}
