<?php

namespace Vanguard\Repositories\Patient;

use Vanguard\Patient;

interface PatientRepository
{

    public function listTast($status_id = 1, $step = null, $step_id = null, $process_by_step = null);

    public function getByStep($search = null,$status = 1,$step);
    
    public function getByProcess($search = null,$status = 1,$step,$process);

    public function paginate($perPage, $search = null,$status = 1, $user_id);

    public function paginatePatient($perPage, $search = null,$status = 1, $user_id);

    public function all();

    public function allPatientByStatus($status);
    
    public function find($id);

    public function findPatientWithBTSQrcode($id);

    public function patientByStatusStep($status, $step, $user_id);

    public function findBy($field, $value);

    public function whereType($type);

    public function create($data);

    public function update($id,$data);

    public function interviewStore($id,$data);

    public function delete($id);

    public function import($file);

    public function patientFamilyStore($data);

    public function checkDuplicate($key);

    public function interviewDone($id);

    public function basicInterviewDone($id, $data);

    public function researchStore($id,$data);

    public function setSearch($id, $source_research,  $status_search_id, $search_description);

    public function researchDone($id, $data);

    public function superiorFinish($patient_id);

    public function fullInterviewAgain($data);

    public function closeCase($id, $data);
}
