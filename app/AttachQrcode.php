<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachQrcode extends Model
{
    use HasFactory;

    protected $table = 'patients_qrcode';

    protected $fillable = ['patient_id', 'date', 'name', 'phone', 'email', 'commune', 'district', 'province', 'result'];

    public function patientIsParentQrcode(){    
  
        return $this->belongsTo('Vanguard\Patient','patient_id'); 
    }
}
