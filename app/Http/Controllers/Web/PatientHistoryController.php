<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\PatientHistory\PatientHistoryRepository;

class PatientHistoryController extends Controller
{
    private $patientHistory;

    public function __construct(
        PatientHistoryRepository $patientHistory
    ) {
        $this->patientHistory = $patientHistory;
    }

    public function store(Request $request)
    {   
        $this->patientHistory->createOrUpdate($request->all(), $request->id);

        updateStep($request->patient_id, 4);

        return redirect(route("list-tasks.fullinterview", ["id" => $request->patient_id])."#PatientHistoryBlock")->withSuccess("Successfully");

    }

}

