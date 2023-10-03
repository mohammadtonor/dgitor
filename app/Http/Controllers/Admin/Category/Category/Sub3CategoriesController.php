<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\SubCategoryDepth3Repo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sub3CategoriesController extends Controller
{
    private $sub3CategoryRepo;

    public function __construct(SubCategoryDepth3Repo $subCategoryDepth3Repo)
    {
        $this->sub3CategoryRepo = $subCategoryDepth3Repo;
    }

    /////////////////////////////////////////////////////////////// page
    public function showSub3CategoryPageInfo($parent_cat_id)
    {
            $result = $this->sub3CategoryRepo->showDepth3SubCategoryPageInfo($parent_cat_id);
//            return response()->json($result);
        return view("Pannel.Category.Sub3", compact('result'));
    }

    /////////////////////////////////////////////////////////////// CRUD
    public function insertSub3Category(Request $request, $parent_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable",
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json($this->sub3CategoryRepo->insertDepth3SubCategory(
                $request->title,
                $request->description,
                $parent_cat_id
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectOneSub3Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub3CategoryRepo->selectOneDepth3SubCategoryById($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllSub3Category($parent_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub3CategoryRepo->selectAllDepth3SubCategories($parent_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteSub3Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub3CategoryRepo->deleteDepth3SubCategor($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreSub3Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->sub3CategoryRepo->restoreDepth3SubCategory($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateSub3Category(Request $request, $sub_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json(["status" => $this->sub3CategoryRepo->updateDepth3SubCategory(
                $sub_cat_id,
                $request->title,
                $request->description
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    /////////////////////////////////////////////////////////////// relations
}
