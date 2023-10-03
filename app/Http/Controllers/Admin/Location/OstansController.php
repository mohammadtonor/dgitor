<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Repository\Location\OstanRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OstansController extends Controller
{
    private $ostanRepo;
    public function __construct(OstanRepo $ostanRepo)
    {
        $this->ostanRepo = $ostanRepo;
    }

    public function showOstanPageInfo($country_id)
    {
            $result = $this->ostanRepo->showOstanPageInfo($country_id);
            return view("Pannel.Settings.Ostans", compact("result"));
    }

    public function insertOstan(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name"   => 'required|string|max:100',
                "country_id" => 'required|numeric'

            ]);
            if ($validator->fails())
                return  response()->json(["status"=>"validation-error", "errors"=>$validator->errors()]);

            return response()->json($this->ostanRepo->insertOstan(
                $request->name,
                $request->country_id
            ));

        }

        return response()->json(["status"=>"refused"]);
    }

    public function selectOstanById($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["result" => $this->ostanRepo->selectOstanById($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAllOstanOfCountry($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->ostanRepo->getAllOstanOfCountry($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteOstan($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->ostanRepo->deleteOstan($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreOstan($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->ostanRepo->restoreOstan($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateOstan($ostan_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name"   => 'nullable|string|max:100',
                "country_id" => 'required|numeric'
            ]);
            if ($validator->fails())
                return response()->json(["status"=>"validation-error", "errors"=>$validator->errors()]);

            return response()->json(["status" => $this->ostanRepo->updateOstan($ostan_id,
                $request->name,
                $request->country_id
            )]);
        }

        return response()->json(["status"=>"refused"]);
    }




    //////////////////////////////////////relation


    public function getCountryOfOstan($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->ostanRepo->getCountryOfOstan($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getCitiesOfOstan($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->ostanRepo->getCitiesOfOstan($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }
}
