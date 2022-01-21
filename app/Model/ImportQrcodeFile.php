<?php

namespace Vanguard\Model;

//use Vanguard\ProjectExcel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportQrcodeFile implements ToModel
{
    
    public function model(array $row)
    {
        return array([
           'no'     => $row[0],
           'date'    => $row[1],
           'name' => $row[2],
           'phone' => $row[3],
           'email' => $row[4],
           'commune' => $row[5],
           'district' => $row[6],
           'province' => $row[7],
           'result' => $row[8],
        ]);
    }
}


