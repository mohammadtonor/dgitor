<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\SubCategoryDepth4Repo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sub4CategoriesController extends Controller
{
    private $sub4CategoryRepo;

    public function __construct(SubCategoryDepth4Repo $subCategoryDepth4Repo)
    {
        $this->sub4CategoryRepo = $subCategoryDepth4Repo;
    }

    /////////////////////////////////////////////////////////////// page
    public function showSub4CategoryPageInfo($parent_cat_id)
    {
            $result = $this->sub4CategoryRepo->showDepth4SubCategoryPageInfo($parent_cat_id);
            return response()->json($result);
//        return view("View_Name", compact('result'));
    }

    /////////////////////////////////////////////////////////////// CRUD
    public function insertSub4Category(Request $request, $parent_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable",
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json($this->sub4CategoryRepo->insertDepth4SubCategory(
                $request->title,
                $request->description,
                $parent_cat_id
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectOneSub4Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub4CategoryRepo->selectOneDepth4SubCategoryById($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllSub4Category($parent_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub4CategoryRepo->selectAllDepth4SubCategories($parent_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteSub4Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub4CategoryRepo->deleteDepth4SubCategor($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreSub4Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub4CategoryRepo->restoreDepth4SubCategory($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateSub4Category(Request $request, $sub_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json(["status" => $this->sub4CategoryRepo->updateDepth4SubCategory(
                $sub_cat_id,
                $request->title,
                $request->description
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    /////////////////////////////////////////////////////////////// relations
}
