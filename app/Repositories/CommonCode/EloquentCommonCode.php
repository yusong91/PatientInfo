<?php

namespace Vanguard\Repositories\CommonCode;

use Vanguard\Model\CommonCode; 
use Carbon\Carbon;
use DB; 
use Illuminate\Database\SQLiteConnection;

class EloquentCommonCode implements CommonCodeRepository 
{

    public function all()
    {
        return CommonCode::all();
    }

    public function create(array $data) 
    {
        return CommonCode::create($data);
    } 

    public function update($id ,array $data){

        return CommonCode::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        $commonCode = CommonCode::find($id);

        return $commonCode->delete();
    }

}