<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Category\Category;
use Illuminate\Support\Facades\DB;

class MainCategoryRepo
{
    // ---------------------------------------- Page ---------------------------------------- //
    public function showMainCategoryPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "main_categories" => []
        ];

        if (DB::table("categories")->count() > 0)
        {
            $pageInfo["count"] = DB::table("categories")->where("depth", 1)->count();
            $mainCategories = Category::withTrashed()->where("depth", 1)->get();

            foreach ($mainCategories as $mainCategory)
            {
                $pageInfo["main_categories"][] = [
                    "category" => $mainCategory,
                    "child_count" => DB::table("categories")->where("category_id", $mainCategory->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertMainCategory($title, $description)
    {
        if (!$this->checkExistsMainCategoryByTitle(null, $title))
        {
            $mainCategory = new Category();
            $mainCategory->title = $title;
            $mainCategory->description = $description;
            $mainCategory->depth = 1;
            $mainCategory->is_main = '1';
            return $mainCategory->save() ?
                ["status" => "success", "result" => $mainCategory] :
                ["status" => "failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectOneMainCategoryById($id)
    {
        if ($this->checkExistsMainCategoryById($id)) {
            return Category::withTrashed()->where("id", $id)->first();
        }
        return "notFound";
    }

    public function selectAllMainCategories()
    {
        return $this->showMainCategoryPageInfo();
    }

    public function deleteMainCategory($id)
    {
        if ($this->checkExistsMainCategoryById($id)) {
            if (DB::table("categories")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Category::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreMainCategory($id)
    {
        if ($this->checkExistsMainCategoryById($id)) {
            if (DB::table("categories")->where("id", $id)->whereNotNull("deleted_at")->exists()) {
                return Category::withTrashed()->where("id", $id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateMainCategory($id, $title, $description)
    {
        if ($this->checkExistsMainCategoryById($id)) {
            if (!$this->checkExistsMainCategoryByTitle($id, $title)) {
                $mainCategory = $this->selectOneMainCategoryById($id);
                if ($title != null) $mainCategory->title = $title;
                $mainCategory->description = $description;
                return $mainCategory->save() ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    // ---------------------------------------- Operation ---------------------------------------- //

    public function checkExistsMainCategoryById($id)
    {
        return DB::table("categories")->where(["id" => $id, "is_main" => '1', "depth" => 1])->exists();
    }

    public function checkExistsMainCategoryByTitle($id, $title)
    {
        if ($title == null) return true;
        $mainCategory = DB::table("categories")->where(["is_main" => '1', "depth" => 1]);
        if ($id != null) $mainCategory->where("id", "<>", $id);
        $mainCategory->where("title", $title);
        return $mainCategory->exists();
    }

    // ---------------------------------------- Relation ---------------------------------------- //
}
