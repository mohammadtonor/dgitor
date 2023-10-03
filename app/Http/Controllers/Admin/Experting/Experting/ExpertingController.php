<?php

namespace App\Http\Controllers\Admin\Experting\Experting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\Experting\ExpertingRepo;
use App\Repository\Experting\Type\ExpertingTypeRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpertingController extends Controller
{
    private $expertingRepo;

    public function __construct(ExpertingRepo $expertingRepo)
    {
        $this->expertingRepo = $expertingRepo;
    }

    //////////////////////////////////Page
    public function showPageInfoForUser($user_id)
    {
        $result = $this->expertingRepo->showExpertingForUserPageInfo($user_id);
//        return view("", compact("result"));
        return $result;
    }

    public function showPageInfoForKarshenas($user_id)
    {
        $result = $this->expertingRepo->showExpertingForKarshenasPageInfo($user_id);
//        return view("", compact("result"));
        return $result;
    }

    //////////////////////////////////CRUD
    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "product_id" => 'nullable',
                "private_experting_id" => 'nullable',
                "public_experting_id" => 'nullable',
                "register_user_id" => 'nullable',
                "karshenas_user_id" => 'nullable',
                "type_id" => 'nullable',
                "address" => 'nullable',
                "postal_code" => 'nullable',
                "city_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->expertingRepo->insertExperting(
                $request->title,
                $request->product_id,
                $request->register_user_id,
                $request->karshenas_user_id,
                $request->type_id,
                $request->postal_code,
                $request->address,
                $request->city_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingRepo->selectExpertingById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingRepo->selectAllExpertings()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingRepo->deleteExperting($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingRepo->restoreExperting($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "product_id" => 'nullable',
                "register_user_id" => 'nullable',
                "karshenas_user_id" => 'nullable',
                "type_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->expertingRepo->updateExperting($id,
                $request->title,
                $request->product_id,
                $request->register_user_id,
                $request->karshenas_user_id,
                $request->type_id,

            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
