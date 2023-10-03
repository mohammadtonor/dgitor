<?php

namespace App\Http\Controllers\Admin\Organization\OrgPosition\Material;

use App\Http\Controllers\Controller;
use App\Repository\Organization\OrgPosition\Material\OrgPositionMaterialRepo;
use App\Repository\Organization\OrgPosition\OrgPositionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrgPositionMaterialController extends Controller
{
    private $orgPositionMaterialRepo;
    public function __construct(OrgPositionMaterialRepo $orgPositionMaterialRepo)
    {
        $this->orgPositionMaterialRepo=$orgPositionMaterialRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($org_postion_id)
    {
        $result = $this->orgPositionMaterialRepo->showOrgPositionMaterialPageInfo($org_postion_id);
        return response()->json(["status"=>"ok","orgPositionMaterial"=>$result]);
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
                "material_type" => 'nullable',
                "org_position_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgPositionMaterialRepo->insertOrgPositionMaterial(
                $request->title??null,
                $request->description??null,
                $request->material_type??null,
                $request->org_position_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->orgPositionMaterialRepo->selectOrgPositionMaterialById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->orgPositionMaterialRepo->selectAllOrgPositionMaterials()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'nullable',
                "description" => 'nullable',
                "material_type" => 'nullable',
                "org_position_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgPositionMaterialRepo->updateOrgPositionMaterial($id,
                $request->title??null,
                $request->description??null,
                $request->material_type??null,
                $request->org_position_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->orgPositionMaterialRepo->deleteOrgPositionMaterial($id)]);
    }
}
