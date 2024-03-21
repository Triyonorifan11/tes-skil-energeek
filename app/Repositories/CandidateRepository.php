<?php

namespace App\Repositories;

use App\Interfaces\CandidateInterface;
use App\Models\candidates;

class CandidateRepository implements CandidateInterface
{

 	 // Your repository logic here 

	  public function getAll($select = [], $withRelations = [], $join = [], $where = null, $search = null, $sortOption = [], $paginateOption = [], $reformat = null)
	  {
		  $skill = candidates::query();
  
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


	  public function findById($id, $withRelations = [], $method = 'findOrFail')
	{
		$candidate = candidates::with($withRelations)->$method($id);

		return $candidate;
	}

	public function updateById($id, $data)
	{
		$candidate = $this->findById($id);

		foreach ($data as $key => $value) {
			$candidate->$key = $value;
		}

		$candidate->save();

		return $candidate;
	}


}
