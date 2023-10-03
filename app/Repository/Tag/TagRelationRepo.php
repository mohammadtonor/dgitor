<?php

namespace App\Repository\Tag;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TagRelationRepo
{
    ////////////////////////////////////////// Relations




    ///////////////////////////// category

    public function getAllTagOfCategory($category_id)
    {
        if ($this->checkExistsCategoryById($category_id))
        {
            return DB::table("tags")->whereIn("id" , DB::table("category_tag")->where("category_id", $category_id)->pluck("tag_id")->toArray())->exists() ?
                DB::table("tags")->whereIn("id", DB::table("category_tag")->where("category_id", $category_id)->pluck("tag_id")->toArray())->get() :
                "notFound";
        }
        return "notFound";
    }

    public function tagsCanAssignedToCategory($category_id)
    {
        if ($this->checkExistsCategoryById($category_id))
        {
            return DB::table("tags")->whereNotIn("id",DB::table("category_tag")
                                                                         ->where("category_id",$category_id)
                                                                         ->pluck("tag_id")->toArray())
                ->count()>0 ?
                                DB::table("tags")->whereNotIn("id",DB::table("category_tag")
                                    ->where("category_id",$category_id)
                                    ->pluck("tag_id")->toArray())->get() :
                                 "tag-notFound";
        }
        return "notFound";
    }

    public function syncTagToCategory($category_id, $tag_ids)
    {
        if ($this->checkExistsCategoryById($category_id))
        {
           DB::beginTransaction();
           if (DB::table("category_tag")->where("category_id",$category_id)->exists())
           {
               if (DB::table("category_tag")->where("category_id",$category_id)->delete()>0)
               {
                   $insert_row_count=0;
                   foreach ($tag_ids as $tag_id)
                   {
                       if (DB::table("category_tag")->insert(["tag_id"=>$tag_id, "category_id"=>$category_id, "created_at" => Carbon::now()]))
                           $insert_row_count++;
                   }

                   if ($insert_row_count==count($tag_ids))
                   {
                       DB::commit();
                       return "success";
                   }
                   DB::rollBack();
                   return "failed";
               }
               DB::rollBack();
               return "failed-delete";
           }
           else
           {
               $insert_row_count=0;
               foreach ($tag_ids as $tag_id)
               {
                   if (DB::table("category_tag")->insert(["tag_id"=>$tag_id, "category_id"=>$category_id, "created_at" => Carbon::now()]))
                       $insert_row_count++;
               }

               if ($insert_row_count==count($tag_ids))
               {
                   DB::commit();
                   return "success";
               }
               DB::rollBack();
               return "failed";
           }
        }
        return "category-notFound";
    }

    public function attachTagToCategory($category_id, $tag_id)
    {
        if ($this->checkExistsCategoryById($category_id))
        {
            if (!DB::table("category_tag")->where(["category_id" => $category_id, "tag_id" => $tag_id])->exists())
            {
                return DB::table("category_tag")->insert(["category_id" => $category_id, "tag_id" => $tag_id, "created_at"=>Carbon::now()]) ?
                    "success" : "failed";
            }
            return  "exists";
        }
        return "category-notFound";
    }

    public function detachTagFromCategory($category_id, $tag_id)
    {
        if ($this->checkExistsCategoryById($category_id))
        {
            if (DB::table("category_tag")->where(["category_id" => $category_id, "tag_id" => $tag_id])->exists())
            {
                return DB::table("category_tag")->where(["category_id" => $category_id, "tag_id" => $tag_id])->delete()>0 ?
                    "success" : "failed";
            }
            return  "notFound";
        }
        return "category-notFound";
    }

    ///////////////////////////// product

    ////////////////////////////////////////// operation

    public function checkExistTagById($tag_id)
    {
        return DB::table("tags")->where("id",$tag_id)->exists();
    }

    public function checkExistsCategoryById($category_id)
    {
        return DB::table("categories")->where("id", $category_id)->exists();
    }



}
