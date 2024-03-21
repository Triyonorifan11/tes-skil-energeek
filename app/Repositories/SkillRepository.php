<?php

namespace App\Repositories;

use App\Interfaces\SkillInterface;
use App\Models\skills;

class SkillRepository implements SkillInterface
{

	// Your repository logic here 

	public function getAll($select = [], $withRelations = [], $join = [], $where = null, $search = null, $sortOption = [], $paginateOption = [], $reformat = null)
	{
		$skill = skills::query();

		if (isset($select) && count($select) > 0) {
			$skill->select($select);
		}

		if (isset($withRelations) && count($withRelations) > 0) {
			$skill->with($withRelations);
		}

		if (isset($join) && count($join) > 0) {
			foreach ($join as $key => $value) {
				$skill->{$value['method']}($value['table'], $value['value']);
			}
		}

		if (isset($where) && is_callable($where)) {
			$skill->where($where);
		}

		if (isset($search) && is_callable($search)) {
			$skill->where($search);
		}

		if (isset($sortOption['orderCol']) && !empty($sortOption['orderCol'])) {
			$skill->orderBy($sortOption['orderCol'], $sortOption['orderDir'] ?? 'ASC');
		}

		if (isset($paginateOption['method']) && !empty($paginateOption['method'])) {
			$skill = $skill->{$paginateOption['method']}(perPage: $paginateOption['length'] ?? 10, page: $paginateOption['page'] ?? null);
		} else {
			$skill = $skill->get();
		}

		if (isset($reformat) && is_callable($reformat)) {
			$skill = $reformat($skill);
		}

		return $skill;
	}

	public function create($data){
		$skills = new skills();

		foreach($data as $key => $value){
			$skills->$key = $value;
		}

		$skills->save();
		return $skills;
	}

	public function findById($id, $withRelations = [], $method = 'findOrFail')
    {
        $skill = skills::with($withRelations)->$method($id);

        return $skill;
    }

	public function updateById($id, $data)
    {
        $skill = $this->findById($id);

        foreach ($data as $key => $value) {
            $skill->$key = $value;
        }

        $skill->save();

        return $skill;
    }


	public function destroy($id)
	{
		$skill = $this->findById($id, ['skill_sets']);

		if(!is_null($skill))
		{
			$skill->delete();
		}

		return $skill;
	}
}
