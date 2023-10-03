<?php

namespace App\Http\Controllers\Admin\Experting\Type;

use App\Http\Controllers\Controller;
use App\Repository\Experting\Type\ExpertingTypeRepo;
use App\Repository\Location\CityRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpertingTypeController extends Controller
{
    private $expertingTypeRepo;

    public function __construct(ExpertingTypeRepo $expertingTypeRepo)
    {
        $this->expertingTypeRepo = $expertingTypeRepo;
    }

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "cost" => 'nullable',
                "is_tasvie" => 'nullable',
                "experting_time" => 'nullable',
                "category_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->expertingTypeRepo->insertExpertingType(
                $request->title,
                $request->cost,
                $request->is_tasvie,
                $request->experting_time,
                $request->category_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingTypeRepo->selectExpertingById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingTypeRepo->selectAllExpertingTypes()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingTypeRepo->deleteExpertingTypes($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingTypeRepo->restoreExpertingTypes($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "cost" => 'nullable',
                "is_tasvie" => 'nullable',
                "experting_time" => 'nullable',
                "category_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->expertingTypeRepo->updateExpertingType($id,
                $request->title,
                $request->cost,
                $request->is_tasvie,
                $request->experting_time,
                $request->category_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
