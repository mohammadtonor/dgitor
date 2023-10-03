<?php

namespace App\Repository\Tag;

use App\Models\Tag\Tag;
use Illuminate\Support\Facades\DB;

class TagRepo
{
    ////////////////////////////////////////////////////// page

    public function showTagPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "tags" => []
        ];
        if (DB::table("tags")->count() > 0)
        {
            $pageInfo["count"] = DB::table("tags")->count();
            $Tags = Tag::withTrashed()->get();
            foreach ($Tags as $tag)
            {
                $pageInfo["tags"][] = [
                    "tag" => $tag,
                    "category_count" => DB::table("category_tag")->where("tag_id",$tag->id)->count(),
                    "product_count" => 0,
                ];
            }
        }
        return $pageInfo;
    }

    ////////////////////////////////////////////////////// CRUD

    public function insertTag($title)
    {
        if (!$this->checkExistsTagByTitle(null, $title))
        {
            $tag = new Tag();
            $tag->title = $title;
            return $tag->save() ?
                ["status" => "success", "result" => $tag] :
                ["status" => "failed"];
        }
        return ["status" => "duplicate"];
    }

    public function getOneTagById($id)
    {
        if ($this->checkExistsTagById($id))
            return Tag::withTrashed()->where("id", $id)->first();
        return "notFound";
    }

    public function selectAllTag()
    {
        return $this->showTagPageInfo();
    }

    public function deleteTag($id)
    {
        if ($this->checkExistsTagById($id)) {
            if (DB::table("tags")->where("id", $id)->whereNull("deleted_at")->exists()){
                return $this->getOneTagById($id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreTag($id)
    {
        if ($this->checkExistsTagById($id))
        {
            if (DB::table("tags")->where("id", $id)->whereNotNull("deleted_at")->exists()){
                return $this->getOneTagById($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateTag($id, $title)
    {
        if ($this->checkExistsTagById($id))
        {
            if (!$this->checkExistsTagByTitle($id, $title))
            {
                $tag = $this->getOneTagById($id);
                $tag->title = $title;
                return $tag->save() ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    ////////////////////////////////////////////////////// operations

    public function checkExistsTagById($id)
    {
        return DB::table("tags")->where("id", $id)->exists();
    }

    public function checkExistsTagByTitle($id, $title)
    {
        if ($title==null) return true;

        $tag = DB::table("tags");
        if ($id != null) $tag->where("id", "<>", $id);
        $tag->where("title", $title);
        return $tag->exists();
    }

    ////////////////////////////////////////////////////// relations

}
