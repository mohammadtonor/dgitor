<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Attribute\Attribute;
use App\Models\Category\Category\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubCategoryDepth4Repo
{
// ---------------------------------------- Page ---------------------------------------- //
    public function showDepth4SubCategoryPageInfo($parent_category_id)
    {
        $pageInfo = [
            "count" => 0,
            "parent_category" => Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 3])->first(),
            "sub_cat" => []
        ];
        if (DB::table("categories")->where("category_id",$parent_category_id)->count() > 0)
        {
            $pageInfo["count"] = DB::table("categories")->where(["category_id" => $parent_category_id, "depth" => 4])->count();
            $depth4Categories = Category::withTrashed()->with("parent")->where(["category_id" => $parent_category_id, "depth" => 4])->get();

            foreach ($depth4Categories as $depth4Category)
            {
                $pageInfo["sub_cat"][] = [
                    "category" => $depth4Category,
                    "child_count" => DB::table("categories")->where("category_id", $depth4Category->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertDepth4SubCategory($title, $description, $parent_category_id)
    {
        if (!$this->checkExistsDepth4SubCategoryByTitle(null, $title))
        {
            DB::beginTransaction();
            $depth4Category = new Category();
            $depth4Category->title = $title;
            $depth4Category->description = $description;
            $depth4Category->depth = 4;
            $depth4Category->category_id = $parent_category_id;
            if ($depth4Category->save())
            {
                $parentCategory = Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 3])->first();
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
                    return ["status"=>"success","result"=>$depth4Category];
                }
                DB::rollBack();
                return ["status"=>"parent-failed"];
            }
            DB::rollBack();
            return ["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectOneDepth4SubCategoryById($id)
    {
        if ($this->checkExistsDepth4SubCategoryById($id))
        {
            return Category::withTrashed()->where("id", $id)->first();
        }
        return "notFound";
    }

    public function selectAllDepth4SubCategories($parent_category_id)
    {
        return $this->showDepth4SubCategoryPageInfo($parent_category_id);
    }

    public function deleteDepth4SubCategor($id)
    {
        if ($this->checkExistsDepth4SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Category::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreDepth4SubCategory($id)
    {
        if ($this->checkExistsDepth4SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Category::withTrashed()->where("id", $id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateDepth4SubCategory($id, $title, $description)
    {
        if ($this->checkExistsDepth4SubCategoryById($id))
        {
            if (!$this->checkExistsDepth4SubCategoryByTitle($id, $title))
            {
                $depth4Category = $this->selectOneDepth4SubCategoryById($id);
                if ($title != null) $depth4Category->title = $title;
                if ($description != null) $depth4Category->description = $description;
                return $depth4Category->save() ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    // ---------------------------------------- Operation ---------------------------------------- //

    public function checkExistsDepth4SubCategoryById($id)
    {
        return DB::table("categories")->where(["id" => $id, "depth" => 4])->exists();
    }

    public function checkExistsDepth4SubCategoryByTitle($id, $title)
    {
        if ($title == null) return true;
        $depth4Category = DB::table("categories")->where(["depth" => 4]);
        if ($id != null) $depth4Category->where("id", "<>", $id);
        $depth4Category->where("title", $title);
        return $depth4Category->exists();
    }

    // ---------------------------------------- Relation ---------------------------------------- //
}
