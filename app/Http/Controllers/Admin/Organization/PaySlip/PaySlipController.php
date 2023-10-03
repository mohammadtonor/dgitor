<?php

namespace App\Http\Controllers\Admin\Organization\PaySlip;

use App\Http\Controllers\Controller;
use App\Repository\Organization\Holding\HoldingRepo;
use App\Repository\Organization\PaySlip\PaySlipRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaySlipController extends Controller
{
    private $paySlipRepo;
    public function __construct(PaySlipRepo $paySlipRepo)
    {
        $this->paySlipRepo=$paySlipRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo($user_id)
    {
        $result = $this->paySlipRepo->showPaySlipPageInfo($user_id);
        return response()->json(["status"=>"ok","paySlip"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'required',
                "haghe_jazb" => 'nullable',
                "salary" => 'nullable',
                "base_salary" => 'nullable',
                "ayab_zohab" => 'nullable',
                "overtime" => 'nullable',
                "food_cost" => 'nullable',
                "manateghe_khas" => 'nullable',
                "haghe_olad" => 'nullable',
                "haghe_maskan" => 'nullable',
                "haghe_mamoriat" => 'nullable',
                "boun" => 'nullable',
                "jame_pardakhti" => 'nullable',
                "khales_pardakhti" => 'nullable',
                "talab" => 'nullable',
                "aghsat_vam" => 'nullable',
                "maliat" => 'nullable',
                "bime" => 'nullable',
                "bime_takmili" => 'nullable',
                "bime_dandanpezeshki" => 'nullable',
                "haghe_sandogh" => 'nullable',
                "mosaedeh" => 'nullable',
                "month_number" => 'nullable',
                "count_day_karkard" => 'nullable',
                "kasre_kar" => 'nullable',
                "user_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->paySlipRepo->insertPaySlip(
                $request->title??null,
                $request->haghe_jazb??null,
                $request->salary??null,
                $request->base_salary??null,
                $request->ayab_zohab??null,
                $request->overtime??null,
                $request->food_cost??null,
                $request->manateghe_khas??null,
                $request->haghe_olad??null,
                $request->haghe_maskan??null,
                $request->haghe_mamoriat??null,
                $request->boun??null,
                $request->jame_pardakhti??null,
                $request->khales_pardakhti??null,
                $request->talab??null,
                $request->aghsat_vam??null,
                $request->maliat??null,
                $request->bime??null,
                $request->bime_takmili??null,
                $request->bime_dandanpezeshki??null,
                $request->haghe_sandogh??null,
                $request->mosaedeh??null,
                $request->month_number??null,
                $request->count_day_karkard??null,
                $request->kasre_kar??null,
                $request->user_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->paySlipRepo->selectPaySlipById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->paySlipRepo->selectAllPaySlips()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "haghe_jazb" => 'nullable',
                "salary" => 'nullable',
                "base_salary" => 'nullable',
                "ayab_zohab" => 'nullable',
                "overtime" => 'nullable',
                "food_cost" => 'nullable',
                "manateghe_khas" => 'nullable',
                "haghe_olad" => 'nullable',
                "haghe_maskan" => 'nullable',
                "haghe_mamoriat" => 'nullable',
                "boun" => 'nullable',
                "jame_pardakhti" => 'nullable',
                "khales_pardakhti" => 'nullable',
                "talab" => 'nullable',
                "aghsat_vam" => 'nullable',
                "maliat" => 'nullable',
                "bime" => 'nullable',
                "bime_takmili" => 'nullable',
                "bime_dandanpezeshki" => 'nullable',
                "haghe_sandogh" => 'nullable',
                "mosaedeh" => 'nullable',
                "month_number" => 'nullable',
                "count_day_karkard" => 'nullable',
                "kasre_kar" => 'nullable',
                "user_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->paySlipRepo->updatePaySlip($id,
                $request->title??null,
                $request->haghe_jazb??null,
                $request->salary??null,
                $request->base_salary??null,
                $request->ayab_zohab??null,
                $request->overtime??null,
                $request->food_cost??null,
                $request->manateghe_khas??null,
                $request->haghe_olad??null,
                $request->haghe_maskan??null,
                $request->haghe_mamoriat??null,
                $request->boun??null,
                $request->jame_pardakhti??null,
                $request->khales_pardakhti??null,
                $request->talab??null,
                $request->aghsat_vam??null,
                $request->maliat??null,
                $request->bime??null,
                $request->bime_takmili??null,
                $request->bime_dandanpezeshki??null,
                $request->haghe_sandogh??null,
                $request->mosaedeh??null,
                $request->month_number??null,
                $request->count_day_karkard??null,
                $request->kasre_kar??null,
                $request->user_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->paySlipRepo->deletePaySlip($id)]);
    }
}
