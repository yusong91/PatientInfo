<?php

namespace Vanguard\Repositories\PatientRelated;

interface PatientRelatedRepository
{
    public function all();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function createOrUpdate(array $data, $id = null);
    public function newOrEdit($id);
    public function listByPatient($patientId);

}
