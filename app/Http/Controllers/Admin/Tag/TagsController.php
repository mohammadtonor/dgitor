<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Repository\Tag\TagRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagsController extends Controller
{
    private $tagRepo;

    public function __construct(TagRepo $tagRepo)
    {
        $this->tagRepo = $tagRepo;
    }

    /////////////////////////////////////////////// page

    public function showTagPageInfo()
    {
        $result = $this->tagRepo->showTagPageInfo();
//        return response()->json($result);
        return view("Pannel.Category.Tags.Tags", compact('result'));
    }

    /////////////////////////////////////////////// CRUD

    public function insertTag(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => "required|string"
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->tagRepo->insertTag(
                $request->title,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function getOneTagById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRepo->getOneTagById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAllTag()
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->tagRepo->selectAllTag());
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteTag($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRepo->deleteTag($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreTag($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRepo->restoreTag($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateTag(Request $request, $id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => "nullable",
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->tagRepo->updateTag(
                $id,
                $request->title,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }


}
