<?php

namespace Vanguard\Repositories\LocationCode;

use Vanguard\LocationCode;

interface LocationCodeRepository
{
    /**
     * Paginate registered location codes.
     *
     * @param $perPage
     * @param null $parentId
     * @return mixed
     */
    public function paginate($perPage, $parentId = 0);

    /**
     * Get all location codes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find location code by id.
     *
     * @param $id LocationCode Id
     * @return LocationCode|null
     */
    public function find($id);


    /**
     * Find location code by any field.
     *
     * @param String $field
     * @param String $value
     * @return LocationCode|null
     */
    public function findBy($field, $value);

    /**
     * Find location codes by type.
     *
     * @param $type LocationCode type
     * @return LocationCode|null
     */
    public function whereType($type);

    /**
     * Create new location code.
     *
     * @param array $data
     * @return LocationCode
     */
    public function create(array $data);

    /**
     * Update specified location code.
     *
     * @param $id LocationCode Id
     * @param array $data
     * @return LocationCode
     */
    public function update($id, array $data);

    /**
     * Remove location code from repository.
     *
     * @param $id LocationCode Id
     * @return bool
     */
    public function delete($id);

    /**
     * Import location code from repository.
     *
     * @param $file
     * @return array
     */
    public function import($file);
}
