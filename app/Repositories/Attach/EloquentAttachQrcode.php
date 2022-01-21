<?php

namespace Vanguard\Repositories\Attach;

use Carbon\Carbon;
use DB;
use Vanguard\AttachQrcode; 
use Vanguard\Patient; 

class EloquentAttachQrcode implements AttachQrcodeRepository
{
  
    public function all()
    {
        return AttachQrcode::all(); 
    }

    public function find($id)
    {
        return AttachQrcode::find($id);
    }

    public function findBy($field, $value)
    {
        return AttachQrcode::where($field, $value)->first();
    }

    public function create($id, $user_id, $data)
    {
        if(AttachQrcode::where('patient_id', $id)->count() > 0)
        {
            DB::table('patients_qrcode')->where(['patient_id'=> $id])->delete();
        }
        
        $insert = DB::table('patients_qrcode')->insert($data); 
    }

    public function delete($id)
    {
        
    }

    
}

