<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\skills;
use App\Http\Requests\StoreskillsRequest;
use App\Http\Requests\UpdateskillsRequest;
use App\Http\Resources\SkillResource;
use App\Interfaces\SkillInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $skillInterface;
    public function __construct(SkillInterface $skillInterface)
    {
        $this->skillInterface = $skillInterface;
    }

    public function index()
    {
        $data = skills::all();
        $data->makeHidden(['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by']);
        return responseApi(OK, false, 'Skill', $data);
    }

    public function get_all_skill(Request $request){
        $skills = $this->skillInterface->getAll(
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
        
        return ResponseFormatter::success($skills, 'Data berhasil ditampilkan');
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
    public function store(StoreskillsRequest $request)
    {
        DB::beginTransaction();
        $skill = $this->skillInterface->create(
            data: $request->all()
        );

        DB::commit();
        return (new SkillResource($skill))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil disimpan'
            ]
        ])->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(skills $skills)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(skills $skills)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateskillsRequest $request, $id)
    {
        DB::beginTransaction();

        $skill = $this->skillInterface->updateById(
            id: $id,
            data: $request->all()
        );

        DB::commit();
        return (new SkillResource($skill))->additional([
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
        $skill = $this->skillInterface->destroy(
            id: $id
        );

        DB::commit();
        return (new SkillResource($skill))->additional([
            'status' => [
                'code' => 200,
                'message' => 'Data berhasil dihapus'
            ]
        ])->response()->setStatusCode(200);
    }
}
