<?php

namespace Vanguard\Repositories\Attach;

use Carbon\Carbon;
use DB;
use Vanguard\AttachBts;
use Vanguard\Patient; 

class EloquentAttachBts implements AttachBtsRepository
{
  
    public function all()
    {
        return AttachBts::all(); 
    }

    public function find($id)
    {
        return AttachBts::find($id);
    }

    public function findBy($field, $value)
    {
        return AttachBts::where($field, $value)->first();
    }

    public function create($id, $user_id, $data)
    {
        if(AttachBts::where('patient_id', $id)->count() > 0)
        {
            DB::table('patients_bts')->where(['patient_id'=> $id])->delete();
        }
        
        $insert = DB::table('patients_bts')->insert($data); 
    }

    public function delete($id)
    {
        
    }

    
}

