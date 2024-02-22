<?php

namespace App\Http\Controllers;

use App\Models\candidates;
use App\Http\Requests\StorecandidatesRequest;
use App\Http\Requests\UpdatecandidatesRequest;
use App\Models\jobs;
use App\Models\skill_sets;
use App\Models\skills;
use App\Services\CandidateService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startYear = 1945;
        $endYear = date('Y');
        $yearsRange = range($startYear, $endYear);
        $yearsRange = array_reverse($yearsRange);
        $data = [
            'title' => 'Apply Kerja',
            'jobs' => jobs::all(),
            'skills' => skills::all(),
            'years' => $yearsRange,
        ];
        return view('apply', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:candidates,name',
            'job_id' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:candidates,email|string',
            'year' => 'required|string',
            'skill' => 'required|array',
        ]);
        if ($validator->fails()) {
            return responseApi(422, false, 'error', $validator->errors());
        }
        $data = $request->all();
       

        
        try {
            CandidateService::store($data);
            return responseApi(OK, false, 'Berhasil Apply', $request->all());
        } catch (\Exception $th) {
            return responseApi(INTERNAL_SERVER_ERROR, true, 'Error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(candidates $candidates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(candidates $candidates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecandidatesRequest $request, candidates $candidates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(candidates $candidates)
    {
        //
    }
}
