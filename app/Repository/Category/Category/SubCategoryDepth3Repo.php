<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Attribute\Attribute;
use App\Models\Category\Category\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SubCategoryDepth3Repo
{
// ---------------------------------------- Page ---------------------------------------- //
    public function showDepth3SubCategoryPageInfo($parent_category_id)
    {
        $pageInfo = [
            "count" => 0,
            "parent_category" => Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 2])->first(),
            "sub_cat" => []
        ];
        if (DB::table("categories")->where("category_id",$parent_category_id)->count() > 0)
        {
            $pageInfo["count"] = DB::table("categories")->where(["category_id" => $parent_category_id, "depth" => 3])->count();
            $depth3Categories = Category::withTrashed()->with("parent")->where(["category_id" => $parent_category_id, "depth" => 3])->get();
            foreach ($depth3Categories as $depth3Category) {
                $pageInfo["sub_cat"][] = [
                    "category" => $depth3Category,
                    "child_count" => DB::table("categories")->where("category_id", $depth3Category->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertDepth3SubCategory($title, $description, $parent_category_id)
    {
        if (!$this->checkExistsDepth3SubCategoryByTitle(null, $title))
        {
            DB::beginTransaction();
            $depth3Category = new Category();
            $depth3Category->title = $title;
            $depth3Category->description = $description;
            $depth3Category->depth = 3;
            $depth3Category->category_id = $parent_category_id;
            if ($depth3Category->save())
            {
                $parentCategory = Category::withTrashed()->where(["id" => $parent_category_id, "depth" => 2])->first();
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
                    return ["status"=>"success","result"=>$depth3Category];
                }
                DB::rollBack();
                return ["status"=>"parent-failed"];
            }
            DB::rollBack();
            return ["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectOneDepth3SubCategoryById($id)
    {
        if ($this->checkExistsDepth3SubCategoryById($id))
        {
            return Category::withTrashed()->where("id", $id)->first();
        }
        return "notFound";
    }

    public function selectAllDepth3SubCategories($parent_category_id)
    {
        return $this->showDepth3SubCategoryPageInfo($parent_category_id);
    }

    public function deleteDepth3SubCategor($id)
    {
        if ($this->checkExistsDepth3SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Category::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreDepth3SubCategory($id)
    {
        if ($this->checkExistsDepth3SubCategoryById($id))
        {
            if (DB::table("categories")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Category::withTrashed()->where("id", $id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateDepth3SubCategory($id, $title, $description)
    {
        if ($this->checkExistsDepth3SubCategoryById($id))
        {
            if (!$this->checkExistsDepth3SubCategoryByTitle($id, $title))
            {
                $depth3Category = $this->selectOneDepth3SubCategoryById($id);
                if ($title != null) $depth3Category->title = $title;
                if ($description != null) $depth3Category->description = $description;
                return $depth3Category->save() ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    // ---------------------------------------- Operation ---------------------------------------- //

    public function checkExistsDepth3SubCategoryById($id)
    {
        return DB::table("categories")->where(["id" => $id, "depth" => 3])->exists();
    }

    public function checkExistsDepth3SubCategoryByTitle($id, $title)
    {
        if ($title == null) return true;
        $depth3Category = DB::table("categories")->where(["depth" => 3]);
        if ($id != null) $depth3Category->where("id", "<>", $id);
        $depth3Category->where("title", $title);
        return $depth3Category->exists();
    }

    // ---------------------------------------- Relation ---------------------------------------- //
}
