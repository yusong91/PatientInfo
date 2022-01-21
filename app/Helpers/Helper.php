<?php 

namespace Vanguard\Helpers;

use Barryvdh\DomPDF\PDF;
use Excel;
use DB;
use Vanguard\Excel\ExcelPatient;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Input;

class Helper {

    public static function addChildMenu()
    {
        echo 'hello helper';
    }

    public static function patientPrint()
    {
        dd('ok');
        $pdf_view = view('pdf.pdf_patient', ['song'=>'សុង']);
//        $path = 'patient.pdf';
//        $digital_file = Storage::putFile('pdf/', $path);
//        if (!Storage::drive('gcs')->exists('pdf/')) {
//            Storage::drive('gcs')->makeDirectory('pdf/'.$path);
//        }
     //   $save_path = getUrl('pdf/'.$path);

        $pdf = PDF::loadHtml($pdf_view);
        return $pdf->download('patient.pdf');
    }

    public static function importPatient()
    {
        return view('patients.import-excel');
    }

    public static function excelPatient()
    {   
        dd('ok');
        $patients = DB::table('patients')->get(['name', 'phone', 'laboratory_date']);

        return Excel::download(new ExcelPatient($patients), 'patient.xlsx');
    }

    public static function district($id)
    {   

        $districts = DB::table('location_codes')->where('parent_code', $id)->where('type','district')->get();

        return response()->json($districts);
    }
 
    public static function commune($id)
    {    
        $communes = DB::table('location_codes')->where('parent_code', $id)->where('type','commune')->get();

        return response()->json($communes);   
    }

    public static function village($id)
    {   
        $villages = DB::table('location_codes')->where('parent_code', $id)->where('type','village')->get();

        return response()->json($villages);   
    }

    public static function getKeyName($first_name, $last_name)
    {
        $keyName = array(

            'ក'=>'K',
            'ខ'=>'K',
            'គ'=>'K',
            'ឃ'=>'K',
            'ង'=>'G',
            'ច'=>'C',
            'ឆ'=>'C',
            'ជ'=>'C',
            'ឈ'=>'C',
            'ញ'=>'N',
            'ដ'=>'D',
            'ឋ'=>'T',
            'ឌ'=>'D',
            'ឍ'=>'T',
            'ណ'=>'N',
            'ត'=>'T',
            'ថ'=>'T',
            'ទ'=>'T',
            'ធ'=>'T',
            'ន'=>'N',
            'ប'=>'B',
            'ផ'=>'P',
            'ព'=>'P',
            'ភ'=>'P',
            'ម'=>'M',
            'យ'=>'Y',
            'រ'=>'R',
            'ល'=>'L',
            'វ'=>'V',
            'ស'=>'S',
            'ហ'=>'H',
            'ឡ'=>'I',
            'អ'=>'Z',
            'K'=>'ក',
            'G'=>'ង',
            'C'=>'ច',
            'N'=>'ញ',
            'D'=>'ដ',
            'T'=>'ត',
            'B'=>'ប',
            'P'=>'ផ',
            'M'=>'ម',
            'Y'=>'យ',
            'R'=>'រ',
            'L'=>'ល',
            'V'=>'វ',
            'S'=>'ស',
            'H'=>'ហ',
            'I'=>'ឡ',
            'Z'=>'អ'
        );

        return $keyName[$first_name] . $keyName[$last_name];
    }

}

