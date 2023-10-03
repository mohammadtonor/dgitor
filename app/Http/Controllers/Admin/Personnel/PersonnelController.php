<?php

namespace App\Http\Controllers\Admin\Personnel;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Favorite\FavoriteRepo;
use App\Repository\Personnel\PersonnelRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PersonnelController extends Controller
{
    private $personnelRepo;
    public function __construct(PersonnelRepo $personnelRepo)
    {
        $this->personnelRepo=$personnelRepo;
    }

    //////////////////////////////////////////page

    public function insertPersonelPageInfo()
    {
        $result = $this->personnelRepo->insertPersonelPageInfo();
        //todo view
        return View("Pannel.Personnel.InsertPersonnel",compact("result"));
    }


    public function showPageInfo()
    {
        $result = $this->personnelRepo->showPersonnelPageInfo();
        return View("Pannel.Personnel.PersonnelList",compact("result"));
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'required',
                "gender" => 'nullable',
                "ncode" => 'required',
                "birthday" => 'nullable',
                "mobile" => 'required',
                "email" => 'nullable',
                "role_ids" => 'required',
                "role_ids.*" => 'required',
                "ostan_id" => 'required',
                "city_id" => 'required',
                "mobile_verification_code" => 'nullable',
                "postal_code" => 'nullable',
                "address" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->personnelRepo->insertPersonnel(
                $request->name??null,
                $request->family,
                $request->gender??null,
                $request->ncode,
                $request->birthday??null,
                $request->mobile,
                $request->email??null,
                $request->role_ids,
                $request->ostan_id,
                $request->city_id,
                $request->mobile_verification_code??null,
                $request->postal_code??null,
                $request->address??null

            ));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($user_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->personnelRepo->selectPersonnelById($user_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }


    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->personnelRepo->getAll()]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->personnelRepo->deletePersonnel($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function restore($user_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->personnelRepo->restorePersonnel($user_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'nullable',
                "gender" => 'nullable',
                "ncode" => 'nullable',
                "birthday" => 'nullable',
                "mobile" => 'nullable',
                "email" => 'nullable',
                "ostan_id" => 'nullable',
                "city_id" => 'nullable'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->personnelRepo->updatePersonnel($id,
                $request->name??null,
                $request->family??null,
                $request->gender??null,
                $request->ncode??null,
                $request->birthday??null,
                $request->mobile??null,
                $request->email??null,
                $request->ostan_id??null,
                $request->city_id??null
            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }



    public function search(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'nullable',
                "ncode" => 'nullable',
                "mobile" => 'nullable',
                "ostan_id" => 'nullable',
                "city_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->personnelRepo->search(
                $request->name??null,
                $request->family??null,
                $request->ncode??null,
                $request->mobile??null,
                $request->ostan_id??null,
                $request->city_id??null,
            ));
        }
        return  response()->json(["status"=>"refused"]);
    }
}
