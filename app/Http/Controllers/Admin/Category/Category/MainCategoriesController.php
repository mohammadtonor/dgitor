<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\MainCategoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MainCategoriesController extends Controller
{
    private $mainCategoryRepo;

    public function __construct(MainCategoryRepo $mainCategoryRepo)
    {
        $this->mainCategoryRepo = $mainCategoryRepo;
    }

    ///////////////////////////////////////page
    public function showMainCategoryPageInfo()
    {
        $result = $this->mainCategoryRepo->showMainCategoryPageInfo();
        return View("Pannel.Category.Category",compact("result"));
    }

    /////////////////////////////////////////////////////////////// CRUD
    public function insertMainCategory(Request $request)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required|string",
                "description" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json(
                $this->mainCategoryRepo->insertMainCategory(
                    $request->title,
                    $request->description
                ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectOneMainCategory($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->mainCategoryRepo->selectOneMainCategoryById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllMainCategory()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->mainCategoryRepo->selectAllMainCategories()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteMainCategory($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->mainCategoryRepo->deleteMainCategory($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreMainCategory($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->mainCategoryRepo->restoreMainCategory($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateMainCategory(Request $request, $id)
    {
        if ($request->hasHeader("Accept") && $request->header("Accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "nullable|string",
                "description" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "error" => $validator->errors()]);

            return response()->json(["status" => $this->mainCategoryRepo->updateMainCategory(
                $id,
                $request->title,
                $request->description
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    /////////////////////////////////////////////////////////////// relations
}
