<?php

namespace App\Http\Controllers\Admin\Organization\Organization;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Holding\HoldingRepo;
use App\Repository\Organization\Organization\OrganizationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    private $organizationRepo;
    public function __construct(OrganizationRepo $organizationRepo)
    {
        $this->organizationRepo=$organizationRepo;
    }

    //////////////////////////////////////////page

    public function showOrganizationPageInfo($holding_id)
    {
        $result = $this->organizationRepo->showOrganizationPageInfo($holding_id);
        return response()->json(["status"=>"ok","favorite"=>$result]);
        //TODO:Return View
    }

    public function showAllOrganizationPageInfo()
    {
        $result = $this->organizationRepo->showAllOrganizationPageInfo();
        return response()->json(["status"=>"ok","favorite"=>$result]);
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
                "holding_id" => 'nullable',
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
            return response()->json(["status" => $this->organizationRepo->insertOrganization(
                $request->title??null,
                $request->description??null,
                $request->holding_id??null,
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
        return response()->json(["status" => $this->organizationRepo->selectOrganizationById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->organizationRepo->selectAllOrganizations()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',
                "holding_id" => 'nullable',
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
            return response()->json(["status" => $this->organizationRepo->updateOrganization($id,
                $request->title??null,
                $request->description??null,
                $request->holding_id??null,
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
        return response()->json(["status" => $this->organizationRepo->deleteOrganization($id)]);
    }
}
