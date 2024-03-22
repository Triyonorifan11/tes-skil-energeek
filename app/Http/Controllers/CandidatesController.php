<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\candidates;
use App\Http\Requests\StorecandidatesRequest;
use App\Http\Requests\UpdatecandidatesRequest;
use App\Http\Resources\CandidateResource;
use App\Interfaces\CandidateInterface;
use App\Models\jobs;
use App\Models\skill_sets;
use App\Models\skills;
use App\Services\CandidateService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $candidateInterface;

    public function __construct(CandidateInterface $candidateInterface)
    {
        $this->candidateInterface = $candidateInterface;
    }

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
     * @OA\Get(
     *   tags={"Api|Candidate"},
     *   path="/api/candidate",
     *   summary="Candidate get_all_candidate",
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

    public function get_all_candidate(Request $request)
    {
        $jobs = $this->candidateInterface->getAll(
            select: [
                'id',
                'name',
                'job_id',
                'email',
                'phone',
                'status',
                'year',
                'created_at',
                'updated_at',
                'deleted_at'
            ],
            withRelations:['jobs:id,name', 'skill_sets.skills:id,name'],
            search: function (Builder $query) use ($request) {
                $query->where('name', 'ILIKE', "%{$request->search}%");
                $query->orWhere('email', 'ILIKE', "%{$request->search}%");
                $query->orWhere('phone', 'ILIKE', "%{$request->search}%");
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
                    $result['jobs'] = $result['jobs']['name'];
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
     *   tags={"Api|Candidate"},
     *   path="/api/candidate/store",
     *   summary="Candidate store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name","job_id","phone", "email", "year", "skill"},
     *       @OA\Property(property="name", type="string"),
     *       @OA\Property(property="job_id", type="string"),
     *       @OA\Property(property="phone", type="string"),
     *       @OA\Property(property="email", type="string"),
     *       @OA\Property(property="year", type="string"),
     *       @OA\Property(property="skill", type="string")
     *     )
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
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
     * @OA\Put(
     *   tags={"Api|Candidate"},
     *   path="/api/candidate/{id}",
     *   summary="Candidate update status",
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
     *       required={"status"},
     *       @OA\Property(property="status", type="string")
     *     )
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function update_status(Request $request, $id){
        DB::beginTransaction();

        $candidate = $this->candidateInterface->updateById(
            id: $id,
            data: $request->all()
        );

        DB::commit();
        return (new CandidateResource($candidate))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil disimpan'
            ]
        ])->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(candidates $candidates)
    {
        //
    }
}
