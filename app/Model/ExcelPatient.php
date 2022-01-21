<?php

namespace Vanguard\Model;

use Vanguard\ProjectExcel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelPatient implements ToModel
{
    public function model(array $row)
    {
        return array([
           'name'     => $row[0],
           'email'    => $row[1],
           'password' => Hash::make($row[2]),
        ]);
    }
}


