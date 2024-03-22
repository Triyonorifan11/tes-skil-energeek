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

     /**
     * @OA\Get(
     *   tags={"Api|Master|Jobs"},
     *   path="/api/master/jobs",
     *   summary="Jobs get_all_jobs",
     *   @OA\Parameter(
     *     name="search",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="sortBy",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="orderBy",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="currentPage",
     *     in="query",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */

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
     * @OA\Post(
     *   tags={"Api|Master|Jobs"},
     *   path="/api/master/jobs",
     *   summary="Jobs store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name"},
     *       @OA\Property(property="name", type="string")
     *     )
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function store(StorejobsRequest $request)
    {
        DB::beginTransaction();
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;
        $request['updated_at'] = now(config('app.timezone'));
        $request['created_at'] = now(config('app.timezone'));
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
     * @OA\Put(
     *   tags={"Api|Master|Jobs"},
     *   path="/api/master/jobs/{id}",
     *   summary="Jobs update",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name"},
     *       @OA\Property(property="name", type="string")
     *     )
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function update(UpdatejobsRequest $request, $id)
    {
        DB::beginTransaction();
        $request['updated_by'] = auth()->user()->id;
        $request['updated_at'] = now(config('app.timezone'));
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
     * @OA\Delete(
     *   tags={"Api|Master|Jobs"},
     *   path="/api/master/jobs/{id}",
     *   summary="Jobs delete",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
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
