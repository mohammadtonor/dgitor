<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Repository\Tag\TagRelationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagRelationsController extends Controller
{
    private $tagRelationRepo;

    public function __construct(TagRelationRepo $tagRelationRepo)
    {
        $this->tagRelationRepo= $tagRelationRepo;
    }

    ///////////////////////////////////// tags

    public function getAllTagOfCategory($category_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRelationRepo->getAllTagOfCategory($category_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function tagsCanAssignedToCategory($category_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRelationRepo->tagsCanAssignedToCategory($category_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function syncTagsToCategory(Request $request, $category_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "tag_ids" => "required",
                "tag_ids.*" => "nullable|numeric"
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-failed", "error" => $validator->errors()]);
            return response()->json(["status" => $this->tagRelationRepo->syncTagToCategory($category_id, $request->tag_ids)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function attachTagToCategory($category_id, $tag_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRelationRepo->attachTagToCategory($category_id, $tag_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function detachTagFromCategory($category_id, $tag_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRelationRepo->detachTagFromCategory($category_id, $tag_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function detachAllTagFromCategory($category_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->tagRelationRepo->detachAllTagFromCategory($category_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

}
