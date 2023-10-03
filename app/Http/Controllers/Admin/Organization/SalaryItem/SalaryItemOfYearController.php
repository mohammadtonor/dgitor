<?php

namespace App\Http\Controllers\Admin\Organization\SalaryItem;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Holding\HoldingRepo;
use App\Repository\Organization\SalaryItem\SalaryItemOfYearRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryItemOfYearController extends Controller
{
    private $salaryItemOfYearRepo;
    public function __construct(SalaryItemOfYearRepo $salaryItemOfYearRepo)
    {
        $this->salaryItemOfYearRepo=$salaryItemOfYearRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($org_id)
    {
        $result = $this->salaryItemOfYearRepo->showSalaryItemOfYearPageInfo($org_id);
        return response()->json(["status"=>"ok","salaryItem"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'required',
                "pardakhti" => 'nullable',
                "org_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->salaryItemOfYearRepo->insertSalaryItemOfYear(
                $request->title??null,
                $request->pardakhti??null,
                $request->org_id??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->salaryItemOfYearRepo->selectSalaryItemOfYearById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->salaryItemOfYearRepo->selectAllSalaryItemOfYears()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "pardakhti" => 'nullable',
                "org_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->salaryItemOfYearRepo->updateSalaryItemOfYear($id,
                $request->title??null,
                $request->pardakhti??null,
                $request->org_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->salaryItemOfYearRepo->deleteSalaryItemOfYear($id)]);
    }
}
