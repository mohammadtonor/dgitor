<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Repository\Location\CountryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    private $countryRepo;

    public function __construct(CountryRepo $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    public function showCountryPageInfo()
    {
            $result = response()->json($this->countryRepo->showCountryPageInfo());
            return View("Pannel.Settings.Countries", compact("result"));
    }

    // ---------------------------------------- CRUD ---------------------------------------- //


    public function insertCountry(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'required|string|max:100',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json($this->countryRepo->insertCountry(
                $request->name ?? null
            ));
        }

        return response()->json(["status" => "refused"]);
    }

    public function selectCountryById($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->countryRepo->selectCountryById($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllCountry()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->countryRepo->selectAllCountry());
        }
        return response()->json(["status" => "refused"]);
    }


    public function deleteCountry($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->countryRepo->deleteCountry($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreCountry($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->countryRepo->restoreCountry($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateCountry($country_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable|string|max:100',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->countryRepo->updateCountry($country_id,
                $request->name,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }


    //////////////////////////////////////relation



    public function getOstansOfCountry($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->countryRepo->getAllOstanOfCountry($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getCityOfCountry($country_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->countryRepo->getAllCityOfCountry($country_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

}
