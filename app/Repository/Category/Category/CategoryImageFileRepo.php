<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Category\Category;
use App\Repository\Utility\FileManagerRepo;
use Illuminate\Support\Facades\DB;

class CategoryImageFileRepo
{


    public $categoryImagePath = "/image/Category/";

    ////////////////////////////////////////////////////////


    ///////////////////////////Operation

    // CheckExists
    public function checkExistCatrgoryById($id)
    {
        return DB::table("categories")->where("id", "=" , $id)->exists();
    }

    public function checkExistCategoryByTitle($cat_id,$title=null)
    {
        if ($title==null) return true;
        $cats=DB::table("categories");
        if ($title!=null) $cats->where("title",$title);
        if ($cat_id!=null) $cats->where("id","<>",$cat_id);
        return $cats->exists();
    }

    public function selectCategoryById($id)
    {
        if ($this->checkExistCatrgoryById($id))
            return Category::where("id",$id)->first();
        return "notFound";

    }
    public function deleteCategory($id)
    {
        if ($this->checkExistCatrgoryById($id))
        {
            $category=$this->selectCategoryById($id);

            if (DB::table("categories")->where("category_id",$category->id)->exists())
            {
                return "failed-haschild";
            }
            else
            {
                return ($category->delete())?"success":"failed";
            }

        }
        return "notFound";
    }


    public function removeFileFromCategory($id)
    {
        $file_path = DB::table("categories")->where("id",$id)->first()->path;
        $removeFile = new FileManagerRepo();
        if ($removeFile->removeFileFromStorage($file_path) == "success")
        {
            if ($this->deleteCategory($id) == "success")
                return 'remove-success';
            return "path-delete-failed";
        }
        return 'remove-failed';
    }

    public function uploadFileForCategory($cat_id, $doc_file)
    {
        if (DB::table("categories")->where("id",$cat_id)->exists())
        {
            $upload_file = new FileManagerRepo();
            if ($doc_file)
            {
                $result = $upload_file->insertFile($doc_file,$this->categoryImagePath.$cat_id);
                if ($result["status"] == "ok")
                {
                    $userTaskFile = $this->selectCategoryById($cat_id);
                    $userTaskFile -> path = $result["path"]."/".$result["filename"];
                    $userTaskFile -> extension = $result["extension"];

                    if ($userTaskFile->save())
                    {
                        return [
                            "status" => "success",
                            "path" => $result["path"]."/".$result["filename"]
                        ];
                    }
                    return ["status" => "failed", "path" => null];
                }
                return ["status" => "upload-failed", "path" => null];
            }
            return ["status" => "image-notExists", "path" => null];
        }
        return ["status" => "category-notFound", "path" => null];

    }

    public function downloadPicOfCategory($cat_id)
    {
        if (DB::table("categories")->where("id",$cat_id)->exists())
        {
            $file_path_array = DB::table("categories")->where("id", $cat_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->download($path);
            return "file-notFound";
        }
        return "notFound";
    }

}
