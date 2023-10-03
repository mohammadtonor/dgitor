<?php

namespace App\Http\Controllers\Admin\Organization\Organization\Dept;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Organization\Dept\OrgDeptRepo;
use App\Repository\Organization\Organization\OrganizationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrgDeptController extends Controller
{
    private $orgDeptRepo;
    public function __construct(OrgDeptRepo $orgDeptRepo)
    {
        $this->orgDeptRepo=$orgDeptRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($org_id)
    {
        $result = $this->orgDeptRepo->showOrgDeptPageInfo($org_id);
        return response()->json(["status"=>"ok","orgDept"=>$result]);
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
                "org_id" => 'nullable',
                "register_number" => 'nullable',
                "economic_number" => 'nullable',
                "address" => 'nullable',
                "postal_code" => 'nullable',
                "tellphone" => 'nullable',
                "fax" => 'nullable',
                "establishment_date" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgDeptRepo->insertOrgDept(
                $request->title??null,
                $request->description??null,
                $request->org_id??null,
                $request->register_number??null,
                $request->economic_number??null,
                $request->address??null,
                $request->postal_code??null,
                $request->tellphone??null,
                $request->fax??null,
                $request->establishment_date??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->orgDeptRepo->selectOrgDeptById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->orgDeptRepo->selectAllOrgDepts()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',
                "org_id" => 'nullable',
                "register_number" => 'nullable',
                "economic_number" => 'nullable',
                "address" => 'nullable',
                "postal_code" => 'nullable',
                "tellphone" => 'nullable',
                "fax" => 'nullable',
                "establishment_date" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->orgDeptRepo->updateOrgDept($id,
                $request->title??null,
                $request->description??null,
                $request->org_id??null,
                $request->register_number??null,
                $request->economic_number??null,
                $request->address??null,
                $request->postal_code??null,
                $request->tellphone??null,
                $request->fax??null,
                $request->establishment_date??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->orgDeptRepo->deleteOrgDept($id)]);
    }
}
