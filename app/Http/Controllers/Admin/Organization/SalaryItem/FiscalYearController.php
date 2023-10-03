<?php

namespace App\Http\Controllers\Admin\Organization\SalaryItem;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Holding\HoldingRepo;
use App\Repository\Organization\SalaryItem\FiscalYearRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FiscalYearController extends Controller
{
    private $fiscalYearRepo;
    public function __construct(FiscalYearRepo $fiscalYearRepo)
    {
        $this->fiscalYearRepo=$fiscalYearRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($mavared_hoghooghe_sals_id)
    {
        $result = $this->fiscalYearRepo->showFiscalYearPageInfo($mavared_hoghooghe_sals_id);
        return response()->json(["status"=>"ok","fiscalYear"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'nullable',
                "start_date" => 'nullable',
                "end_date" => 'nullable',
                "darayi" => 'nullable',
                "bedehi" => 'nullable',
                "sarmaye" => 'nullable',
                "sood" => 'nullable',
                "zian" => 'nullable',
                "gardeshe_vojoohe_naghd" => 'nullable',
                "pardakhti" => 'nullable',
                "mavared_hoghooghe_sals_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->fiscalYearRepo->insertFiscalYear(
                $request->title??null,
                $request->start_date??null,
                $request->end_date??null,
                $request->darayi??null,
                $request->bedehi??null,
                $request->sarmaye??null,
                $request->sood??null,
                $request->zian??null,
                $request->gardeshe_vojoohe_naghd??null,
                $request->pardakhti??null,
                $request->mavared_hoghooghe_sals_id??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->fiscalYearRepo->selectFiscalYearById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->fiscalYearRepo->selectAllFiscalYears()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "start_date" => 'nullable',
                "end_date" => 'nullable',
                "darayi" => 'nullable',
                "bedehi" => 'nullable',
                "sarmaye" => 'nullable',
                "sood" => 'nullable',
                "zian" => 'nullable',
                "gardeshe_vojoohe_naghd" => 'nullable',
                "pardakhti" => 'nullable',
                "mavared_hoghooghe_sals_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->fiscalYearRepo->updateFiscalYear($id,
                $request->title??null,
                $request->start_date??null,
                $request->end_date??null,
                $request->darayi??null,
                $request->bedehi??null,
                $request->sarmaye??null,
                $request->sood??null,
                $request->zian??null,
                $request->gardeshe_vojoohe_naghd??null,
                $request->pardakhti??null,
                $request->mavared_hoghooghe_sals_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->fiscalYearRepo->deleteFiscalYear($id)]);
    }
}
