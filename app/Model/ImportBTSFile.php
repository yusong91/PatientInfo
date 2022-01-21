<?php

namespace Vanguard\Model;

//use Vanguard\ProjectExcel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportBTSFile implements ToModel
{
    
    public function model(array $row)
    {
        return array([
           'no'     => $row[0],
           'time'    => $row[1],
           'date' => $row[2],
           'latlon' => $row[3],
           'address' => $row[4],
        ]);
    }
}


