<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Attribute\Attribute;
use App\Models\Category\Category\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubCategoryDepth2Repo
{
// ---------------------------------------- Page ---------------------------------------- //

    public function showDepth2SubCategoryPageInfo($parent_category_id)
    {
        $pageInfo = [
            "count" => 0,
            "parent_category" => Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 1])->first(),
            "sub_cat" => []
        ];
        if (DB::table("categories")->where("category_id",$parent_category_id)->count() > 0)
        {
            $pageInfo["count"] = DB::table("categories")->where(["category_id" => $parent_category_id, "depth" => 2])->count();
            $depth2Categories = Category::withTrashed()->with("parent")->where(["category_id" => $parent_category_id, "depth" => 2])->get();
            foreach ($depth2Categories as $depth2Category) {
                $pageInfo["sub_cat"][] = [
                    "category" => $depth2Category,
                    "child_count" => DB::table("categories")->where("category_id", $depth2Category->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertDepth2SubCategory($title, $description, $parent_category_id)
    {
        if (!$this->checkExistsDepth2SubCategoryByTitle(null, $title))
        {
            DB::beginTransaction();
            $depth2Category = new Category();
            $depth2Category->title = $title;
            $depth2Category->description = $description;
            $depth2Category->depth = 2;
            $depth2Category->category_id = $parent_category_id;
            if ($depth2Category->save())
            {
                $parentCategory = Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 1])->first();
                $parentCategory->has_child = '1';
                $parentCategory->child_count += 1;
                if ($parentCategory->save())
                {

                    $allAttrOfParentCat=DB::table("attributes")->where("category_id",$parent_category_id)->whereNull("deleted_at")->get();
                    foreach ($allAttrOfParentCat as $attr)
                    {
                        $allValuesOfAttr=DB::table("default_values")->where("attribute_id",$attr->id)->get();

                        $newAttr=new Attribute();
                        $newAttr->title=$attr->title;
                        $newAttr->catgeory_id=$attr->category_id;
                        if ($newAttr->save())
                        {
                            foreach ($allValuesOfAttr as $attrValue)
                            {
                                DB::table("default_values")->insert(["title"=>$attrValue->title,"attribute_id"=>$newAttr->id,
                                    "created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]);
                            }
                        }
                    }

                    DB::commit();
                    return ["status"=>"success","result"=>$depth2Category];
                }
                DB::rollBack();
                return ["status"=>"parent-failed"];
            }
            DB::rollBack();
            return ["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectOneDepth2SubCategoryById($id)
    {
        if ($this->checkExistsDepth2SubCategoryById($id))
        {
            return Category::withTrashed()->where("id", $id)->first();
        }
        return "notFound";
    }

    public function selectAllDepth2SubCategories($parent_category_id)
    {
        return $this->showDepth2SubCategoryPageInfo($parent_category_id);
    }

    public function deleteDepth2SubCategor($id)
    {
        if ($this->checkExistsDepth2SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Category::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreDepth2SubCategory($id)
    {
        if ($this->checkExistsDepth2SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Category::withTrashed()->where("id", $id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateDepth2SubCategory($id, $title, $description)
    {
        if ($this->checkExistsDepth2SubCategoryById($id))
        {
            if (!$this->checkExistsDepth2SubCategoryByTitle($id, $title))
            {
                $depth2Category = $this->selectOneDepth2SubCategoryById($id);
                if ($title != null) $depth2Category->title = $title;
                if ($description != null) $depth2Category->description = $description;
                return $depth2Category->save() ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    // ---------------------------------------- Operation ---------------------------------------- //
    public function checkExistsDepth2SubCategoryById($id)
    {
        return DB::table("categories")->where(["id" => $id, "depth" => 2])->exists();
    }

    public function checkExistsDepth2SubCategoryByTitle($id, $title)
    {
        if ($title == null) return true;
        $depth2Category = DB::table("categories")->where(["depth" => 2]);
        if ($id != null) $depth2Category->where("id", "<>", $id);
        $depth2Category->where("title", $title);
        return $depth2Category->exists();
    }

    // ---------------------------------------- Relation ---------------------------------------- //
}
