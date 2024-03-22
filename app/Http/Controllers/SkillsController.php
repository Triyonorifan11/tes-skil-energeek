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

     /**
     * @OA\Get(
     *   tags={"Api|Master|Skill"},
     *   path="/api/master/skill",
     *   summary="Skill get_all_skill",
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
     * @OA\Post(
     *   tags={"Api|Master|Skill"},
     *   path="/api/master/skill",
     *   summary="Skill store",
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
    public function store(StoreskillsRequest $request)
    {
        DB::beginTransaction();
        $request['created_by'] = auth()->user()->id;
        $request['updated_by'] = auth()->user()->id;
        $request['updated_at'] = now(config('app.timezone'));
        $request['created_at'] = now(config('app.timezone'));
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
     * @OA\Put(
     *   tags={"Api|Master|Skill"},
     *   path="/api/master/skill/{id}",
     *   summary="Skill update",
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
    public function update(UpdateskillsRequest $request, $id)
    {
        DB::beginTransaction();
        $request['updated_by'] = auth()->user()->id;
        $request['updated_at'] = now(config('app.timezone'));
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
     * @OA\Delete(
     *   tags={"Api|Master|Skill"},
     *   path="/api/master/skill/{id}",
     *   summary="Skill delete",
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
