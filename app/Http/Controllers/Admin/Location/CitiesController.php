<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Repository\Location\CityRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{
    private $cityRepo;

    public function __construct(CityRepo $cityRepo)
    {
        $this->cityRepo = $cityRepo;
    }

    public function showCityPageInfo($ostan_id)
    {
        $result = response()->json($this->cityRepo->showCityPageInfo($ostan_id));
        return View("Pannel.Settings.city", compact("result"));
    }

    public function insertcity(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "name" => 'required|string|max:100',
                "ostan_id" => 'required|numeric',
                "country_id" => 'required|numeric'
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->cityRepo->insertCity(
                $request->name,
                $request->ostan_id,
                $request->country_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectCityById($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->selectCityById($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAllCity($ostan_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->getAllCity($ostan_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteCity($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->deleteCity($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreCity($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->restoreCity($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateCity($city_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable|string|max:100',
                "ostan_id" => 'required|numeric',
                "country_id" => 'required|numeric'
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->cityRepo->updateCity(
                $city_id,
                $request->name,
                $request->ostan_id,
                $request->country_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    //////////////////////////////////////relation

    public function getUsersOfCity($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->getAllUserOfCity($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getCountryOfCity($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->getCountryOfCity($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getOstansOfCity($city_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->cityRepo->getOstanOfCity($city_id)]);
        }
        return response()->json(["status" => "refused"]);
    }
}
