<?php

namespace App\Http\Controllers\Admin\Organization\Organization\Dept;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Organization\Dept\OrgDeptRelationRepo;
use App\Repository\Organization\Organization\Dept\OrgDeptRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrgDeptRelationController extends Controller
{
    private $orgDeptRelationRepo;
    public function __construct(OrgDeptRelationRepo $orgDeptRelationRepo)
    {
        $this->orgDeptRelationRepo=$orgDeptRelationRepo;
    }


    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "type_relation" => 'required',
                "org_dept1_id" => 'nullable',
                "org_dept2_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgDeptRelationRepo->insertOrgDeptRelation(
                $request->type_relation??null,
                $request->org_dept1_id??null,
                $request->org_dept2_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->orgDeptRelationRepo->selectOrgDeptRelationById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->orgDeptRelationRepo->selectAllOrgDeptRelations()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "type_relation" => 'required',
                "org_dept1_id" => 'nullable',
                "org_dept2_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgDeptRelationRepo->updateOrgDeptRelation($id,
                $request->type_relation??null,
                $request->org_dept1_id??null,
                $request->org_dept2_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->orgDeptRelationRepo->deleteOrgDeptRelation($id)]);
    }
}
