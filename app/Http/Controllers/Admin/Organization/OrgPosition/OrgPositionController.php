<?php

namespace App\Http\Controllers\Admin\Organization\OrgPosition;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Organization\Dept\OrgDeptRepo;
use App\Repository\Organization\OrgPosition\OrgPositionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrgPositionController extends Controller
{
    private $orgPositionRepo;
    public function __construct(OrgPositionRepo $orgPositionRepo)
    {
        $this->orgPositionRepo=$orgPositionRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo()
    {
        $result = $this->orgPositionRepo->showOrgPositionPageInfo();
        return response()->json(["status"=>"ok","orgPosition"=>$result]);
        //TODO:Return View
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'required',
                "description" => 'nullable',
                "org_dept_id" => 'nullable',
                "org_position_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgPositionRepo->insertOrgPosition(
                $request->title??null,
                $request->description??null,
                $request->org_dept_id??null,
                $request->org_position_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->orgPositionRepo->selectOrgPositionById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->orgPositionRepo->selectAllOrgPositions()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',
                "org_dept_id" => 'nullable',
                "org_position_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgPositionRepo->updateOrgPosition($id,
                $request->title??null,
                $request->description??null,
                $request->org_dept_id??null,
                $request->org_position_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->orgPositionRepo->deleteOrgPosition($id)]);
    }
}
