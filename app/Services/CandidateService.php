<?php

namespace App\Services;

use App\Models\candidates;
use App\Models\skill_sets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateService
{
    // Your service logic here
    public static function store($data)
    {
        $candidates = new candidates();
        $candidates->job_id = $data['job_id'];
        $candidates->name = $data['name'];
        $candidates->email = $data['email'];
        $candidates->phone = $data['phone'];
        $candidates->year = $data['year'];
        $candidates->created_by = $candidates->id;
        $candidates->updated_by = null;
        $candidates->deleted_by = null;
        $candidates->created_at = date(now());
        $candidates->updated_at = null;
        $candidates->deleted_at = null;
        DB::beginTransaction();
        try {
            $candidates->save();
            foreach ($data['skill'] as $dtl) {
                $skills = new skill_sets();
                $skills->candidate_id = $candidates->id;
                $skills->skill_id = $dtl;
                $skills->created_at = date(now());
                $skills->updated_at = null;
                $skills->save();
            }
            DB::commit();
            return $candidates;
        } catch (\Throwable $th) {
            DB::rollback();
            return $th;
        }
    }
}
