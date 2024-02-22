<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use App\Http\Requests\StorejobsRequest;
use App\Http\Requests\UpdatejobsRequest;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = jobs::all();
        $data->makeHidden(['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by']);
        return responseApi(OK, false, 'Jabatan', $data);
    }

    public function year(){
        $startYear = 1945;
        $endYear = date('Y');
        $yearsRange = range($startYear, $endYear);
        $yearsRange = array_reverse($yearsRange);
        return responseApi(OK, false, 'year', $yearsRange);
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
    public function store(StorejobsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(jobs $jobs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(jobs $jobs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatejobsRequest $request, jobs $jobs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jobs $jobs)
    {
        //
    }
}