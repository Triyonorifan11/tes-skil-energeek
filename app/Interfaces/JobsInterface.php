<?php

namespace App\Interfaces;

interface JobsInterface
{
    
    public function getAll($select = [], $withRelations = [], $join = [], $where = null, $search = null, $sortOption = [], $paginateOption = [], $reformat = null);
    public function create($data);
    public function findById($id, $withRelations = [], $method = 'findOrFail');
    public function updateById($id, $data);
    public function destroy($id);

}