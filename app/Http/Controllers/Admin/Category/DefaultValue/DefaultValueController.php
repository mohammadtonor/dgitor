<?php

namespace App\Http\Controllers\Admin\Category\DefaultValue;

use App\Repository\Category\DefaultValue\DefaultValueRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DefaultValueController
{
    private $defaultValueRepo;

    public function __construct(DefaultValueRepo $defaultValueRepo)
    {
        $this->defaultValueRepo = $defaultValueRepo;
    }

    //////////////////////////////// Page

    public function showPage($attr_id)
    {
            $result = $this->defaultValueRepo->showDefaultValuesPageInfo($attr_id);
            return response()->json($result);
//          return View("", compact("result"));
    }

    //////////////////////////////// CRUD

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title"   => 'required|string|max:100',
                "attr_id"   => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->defaultValueRepo->insertValue(
                $request->title,
                $request->attr_id,
            ));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->defaultValueRepo->selectValueById($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectAll($attr_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->defaultValueRepo->selectAllValues($attr_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->defaultValueRepo->deleteValue($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title"   => 'nullable|string|max:100',
                "attr_id"   => 'required',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->defaultValueRepo->updateValue($id,
                $request->title,
                $request->attr_id,
            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }
    //////////////////////////////// Relation


}
