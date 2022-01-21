<?php

namespace Vanguard\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ExcelPatient implements FromCollection, WithHeadings
{
    use Exportable;

    private $patient = []; 

    public function __construct($data) 
    {
        $i = 1;

        foreach ($data as $item) { 

            $date = Carbon::parse($item->laboratory_date)->format('d-m-Y');
            
            $data = [$i, $item->name, $item->phone, $date];

            $this->patient[] = $data;

            $i++;
        }
    }

    public function collection()
    {
        return collect(
            $this->patient
        );
    }

    public function headings(): array
    {
        return [];
    }

}