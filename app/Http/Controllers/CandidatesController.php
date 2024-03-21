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
