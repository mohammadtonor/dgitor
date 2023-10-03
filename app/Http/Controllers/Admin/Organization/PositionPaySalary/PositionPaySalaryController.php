<?php

namespace App\Http\Controllers\Admin\Organization\PositionPaySalary;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Holding\HoldingRepo;
use App\Repository\Organization\PositionPaySalary\PositionPaySalaryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionPaySalaryController extends Controller
{
    private $positionPaySalaryRepo;
    public function __construct(PositionPaySalaryRepo $positionPaySalaryRepo)
    {
        $this->positionPaySalaryRepo=$positionPaySalaryRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo()
    {
        $result = $this->positionPaySalaryRepo->showPositionPaysalaryPageInfo();
        return response()->json(["status"=>"ok","positionPaySalary"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "position_id" => 'nullable',
                "pay_id" => 'nullable',
                "salary_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->positionPaySalaryRepo->insertPositionPaysalary(
                $request->position_id??null,
                $request->pay_id??null,
                $request->salary_id??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->positionPaySalaryRepo->selectPositionPaysalaryById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->positionPaySalaryRepo->selectAllPositionPaysalarys()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "position_id" => 'nullable',
                "pay_id" => 'nullable',
                "salary_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->positionPaySalaryRepo->updatePositionPaysalary($id,
                $request->position_id??null,
                $request->pay_id??null,
                $request->salary_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->positionPaySalaryRepo->deletePositionPaysalary($id)]);
    }
}
