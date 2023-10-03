<?php

namespace App\Http\Controllers\Admin\Category\Attribute;

use App\Repository\Category\Attribute\AttributeRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AttributeController
{
    private $attributeRepo;

    public function __construct(AttributeRepo $attributeRepo)
    {
        $this->attributeRepo = $attributeRepo;
    }

    ////////////////////////////////////////// Page

    public function showPage($cat_id)
    {
            $result = $this->attributeRepo->showAttributePageInfo($cat_id);
//            return response()->json($result);
          return View("Pannel.Category.AttrCategory", compact("result"));
    }

    ////////////////////////////////////////// CRUD

    public function insert($cat_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title"   => 'required',
            ]);

            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->attributeRepo->insertAttribute(
                $request->title,
                $cat_id
            ));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->selectAttributeById($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectAll($cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->selectAllAttrOfCat($cat_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }


    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->deleteAttribute($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }


    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->restoreAttribute($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function update($id, $cat_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title"   => 'nullable|string|max:100',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->attributeRepo->updateAttribute($id,
                $request->title,
                $cat_id,
            )]);

        }
        return  response()->json(["status"=>"refused"]);
    }

    ////////////////////////////////////////// Relation

    public function getCategoryOfAttribute($attr_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->getCategoryOfAttribute($attr_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function getAllValuesOfAttribute($attr_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->attributeRepo->getAllValuesOfAttribute($attr_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }




}
