<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\jobs;
use App\Http\Requests\StorejobsRequest;
use App\Http\Requests\UpdatejobsRequest;
use App\Http\Resources\JobsResource;
use App\Interfaces\JobsInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $jobsinterface;
    public function __construct(JobsInterface $jobsInterface)
    {
        $this->jobsinterface = $jobsInterface;
    }

    public function index()
    {
        $data = jobs::all();
        $data->makeHidden(['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by']);
        return responseApi(OK, false, 'Jabatan', $data);
    }

    public function year()
    {
        $startYear = 1945;
        $endYear = date('Y');
        $yearsRange = range($startYear, $endYear);
        $yearsRange = array_reverse($yearsRange);
        return responseApi(OK, false, 'year', $yearsRange);
    }

    public function get_all_jobs(Request $request)
    {
        $jobs = $this->jobsinterface->getAll(
            select: [
                'id',
                'name',
                'created_at',
                'updated_at',
                'deleted_at'
            ],
            search: function (Builder $query) use ($request) {
                $query->where('name', 'ILIKE', "%{$request->search}%");
            },
            sortOption: [
                'orderCol' => $request->sort_by,
                'orderDir' => $request->order_by
            ],
            paginateOption: [
                'method' => 'paginate',
                'length' => $request->limit,
                'page' => $request->current_page
            ],
            reformat: function ($data) {
                return $data->through(function ($item, $key) {
                    $result = $item->toArray();
                    return $result;
                });
            }
        );
        
        return ResponseFormatter::success($jobs, 'Data berhasil ditampilkan');
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
        DB::beginTransaction();
        $jobs = $this->jobsinterface->create(
            data: $request->all()
        );

        DB::commit();
        return (new JobsResource($jobs))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil disimpan'
            ]
        ])->response()->setStatusCode(200);
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
    public function update(UpdatejobsRequest $request, $id)
    {
        DB::beginTransaction();

        $jobs = $this->jobsinterface->updateById(
            id: $id,
            data: $request->all()
        );

        DB::commit();
        return (new JobsResource($jobs))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil disimpan'
            ]
        ])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $jobs = $this->jobsinterface->destroy(
            id: $id
        );

        DB::commit();
        return (new JobsResource($jobs))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil dihapus'
            ]
        ])->response()->setStatusCode(200);
    }
}
