<?php

namespace Vanguard\Repositories\PatientFamily;

interface PatientFamilyRepository
{
    public function all();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function listByPatient($patientId);

}
