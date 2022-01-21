<?php

namespace Vanguard\Repositories\CommonCode;

interface CommonCodeRepository
{
    
    public function all();
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);

}
