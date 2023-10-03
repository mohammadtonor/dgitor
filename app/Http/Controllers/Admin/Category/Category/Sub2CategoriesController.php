<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\SubCategoryDepth2Repo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Sub2CategoriesController extends Controller
{
    private $sub2CategoryRepo;

    public function __construct(SubCategoryDepth2Repo $subCategoryDepth2Repo)
    {
        $this->sub2CategoryRepo = $subCategoryDepth2Repo;
    }

    /////////////////////////////////////////////////////////////// page
    public function showSub2CategoryPageInfo($parent_cat_id)
    {
          $result = $this->sub2CategoryRepo->showDepth2SubCategoryPageInfo($parent_cat_id);
//          return response()->json($result);
//          return View("View_Name", compact("result"));

        return View("Pannel.Category.Sub2",compact("result"));
    }

    /////////////////////////////////////////////////////////////// CRUD
    public function insertSub2Category(Request $request, $parent_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable",
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json($this->sub2CategoryRepo->insertDepth2SubCategory(
                $request->title,
                $request->description,
                $parent_cat_id
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectOneSub2Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->sub2CategoryRepo->selectOneDepth2SubCategoryById($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllSub2Category($parent_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->sub2CategoryRepo->selectAllDepth2SubCategories($parent_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteSub2Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->sub2CategoryRepo->deleteDepth2SubCategor($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreSub2Category($sub_cat_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->sub2CategoryRepo->restoreDepth2SubCategory($sub_cat_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateSub2Category(Request $request, $sub_cat_id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => "required",
                "description" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);
            return response()->json(["status" => $this->sub2CategoryRepo->updateDepth2SubCategory(
                $sub_cat_id,
                $request->title,
                $request->description
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    /////////////////////////////////////////////////////////////// Relation
}
