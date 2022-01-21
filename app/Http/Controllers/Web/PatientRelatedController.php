<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Repositories\PatientRelated\PatientRelatedRepository;

class PatientRelatedController extends Controller
{
    private $patientRelated;

    public function __construct(
        PatientRelatedRepository $patientRelated
    ) {
        $this->patientRelated = $patientRelated;
    }

    public function store(Request $request)
    {   
        $this->patientRelated->createOrUpdate($request->all(), $request->id);

        return redirect(route("list-tasks.fullinterview", ["id" => $request->patient_id])."#PatientRelatedBlock")->withSuccess("Successfully");
    }

    public function destroy(Request $request)
    {
        $this->patientRelated->delete($request->id);

        return redirect(route("list-tasks.fullinterview", ["id" => $request->patient_id])."#PatientRelatedBlock")->withSuccess("Successfully");
    }

    public function editPatientRelated($id)
    {   
        $edit = $this->patientRelated->newOrEdit($id);
        
        return response()->json($edit);
    }

    public function edit(Request $request)
    {
        $affect = $this->patientRelated->newOrEdit($request->id);

    }
}
