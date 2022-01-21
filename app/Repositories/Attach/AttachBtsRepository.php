<?php

namespace Vanguard\Repositories\Attach;

interface AttachBtsRepository
{
   
    public function all();
   
    public function find($id);

    public function findBy($field, $value);

    public function create($id, $user_id, $data);

    public function delete($id);
}
