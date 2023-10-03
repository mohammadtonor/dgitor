<?php

namespace App\Http\Controllers\Admin\Organization\OrgPosition\PositionUserArchive;

use App\Http\Controllers\Controller;
use App\Repository\Organization\OrgPosition\Material\OrgPositionMaterialRepo;
use App\Repository\Organization\OrgPosition\PositionUserArchive\PositionUserArchiveRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionUserArchiveController extends Controller
{
    private $positionUserArchiveRepo;
    public function __construct(PositionUserArchiveRepo $positionUserArchiveRepo)
    {
        $this->positionUserArchiveRepo=$positionUserArchiveRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($user_id)
    {
        $result = $this->positionUserArchiveRepo->showPositionUserArchivePageInfo($user_id);
        return response()->json(["status"=>"ok","orgPositionMaterial"=>$result]);
        //TODO:Return View
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "position_id" => 'required',
                "user_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->positionUserArchiveRepo->insertPositionUserArchive(
                $request->position_id??null,
                $request->user_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->positionUserArchiveRepo->selectPositionUserArchiveById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->positionUserArchiveRepo->selectAllPositionUserArchives()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "position_id" => 'nullable',
                "user_id" => 'nullable',


            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->positionUserArchiveRepo->updatePositionUserArchive($id,
                $request->position_id??null,
                $request->user_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->positionUserArchiveRepo->deletePositionUserArchive($id)]);
    }
}
