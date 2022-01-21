<?php

namespace Vanguard\Repositories\LocationCode;

use DB;
use Vanguard\LocationCode;
//use Maatwebsite\Excel\Facades\Excel;
//use Vanguard\Imports\LocationCodesImport;

class EloquentLocationCode implements LocationCodeRepository
{
    /**
     * {@inheritdoc}
     */
    public function paginate($perPage, $parentCode = 0, $with = [])
    {
        return LocationCode::orderBy('code', 'asc')
//        withCount('children')
//            ->with($with)
//            ->whereParentCode($parentCode)

            ->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return LocationCode::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return LocationCode::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findBy($field, $value)
    {
        return LocationCode::where($field, $value)->first();
    }

    /**
     * {@inheritdoc}
     */
    public function whereType($type)
    {
        return LocationCode::whereType($type)->get();
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $locationCode = LocationCode::create($data);
        return $locationCode;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $locationCode = $this->find($id);

        $locationCode->update($data);

        return $locationCode;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $locationCode = $this->find($id);

        return $locationCode->forceDelete();
    }

    /**
     * {@inheritdoc}
     */
    function import($files) {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        DB::beginTransaction();
        try {
            foreach ($files as $file) {
                Excel::import(new LocationCodesImport, $file);
            }
            DB::commit();
            return [
                'success' => true,
                'message' => 'Completed!!!'
            ];
        } catch (ValidationException $ex) {
            DB::rollback();
            return [
                'success' => false,
                'message' => $ex->getMessage()
            ];
        }
    }
}
