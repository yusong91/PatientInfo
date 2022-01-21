<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;

class FormStep1Controller extends Controller
{
    public function index(){
        return view('forms.index');
    }
    public function form2(){
        return view('forms.form2');
    }
    public function form3(){
        return view('forms.form3');
    }
    public function form4(){
        return view('forms.form4');
    }
    public function formExport(){
        return view('forms.form-export');
    }
}
