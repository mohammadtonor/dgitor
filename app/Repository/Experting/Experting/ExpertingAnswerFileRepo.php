<?php

namespace App\Repository\Experting\Experting;

use App\Models\Category\Category\Category;
use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Experting\ExpertingAnswer;
use App\Models\Experting\Experting\ExpertingAnswerFile;
use App\Repository\Utility\FileManagerRepo;
use Illuminate\Support\Facades\DB;

class ExpertingAnswerFileRepo
{


    public $expertingAnswerImagePath = "/image/ExpertingAnswer/";

    ////////////////////////////////////////////////////////


    ///////////////////////////Operation

    // CheckExists
    public function checkExistExpertingAnswerById($id)
    {
        return DB::table("experting_answer_files")->where("id", "=" , $id)->exists();
    }

    public function checkExistExpertingAnswerByTitle($exp_id,$title=null)
    {
        if ($title==null) return true;
        $cats=DB::table("experting_answer_files");
        if ($title!=null) $cats->where("title",$title);
        if ($exp_id!=null) $cats->where("id","<>",$exp_id);
        return $cats->exists();
    }

    public function selectExpertingAnswerById($id)
    {
        if ($this->checkExistExpertingAnswerById($id))
            return ExpertingAnswer::withTrashed()->where("id",$id)->first();
        return "notFound";

    }
//    public function deleteCategory($id)
//    {
//        if ($this->checkExistCatrgoryById($id))
//        {
//            $category=$this->selectCategoryById($id);
//
//            if (DB::table("categories")->where("category_id",$category->id)->exists())
//            {
//                return "failed-haschild";
//            }
//            else
//            {
//                return ($category->delete())?"success":"failed";
//            }
//
//        }
//        return "notFound";
//    }

    public function deleteExpertingAnswer($id)
    {
        if ($this->checkExistExpertingAnswerById($id))
        {
            if (DB::table("experting_answers")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ExpertingAnswer::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }


    public function removeFileFromExpertingAnswer($id)
    {
        $file_path = DB::table("experting_answer_files")->where("id",$id)->first()->path;
        $removeFile = new FileManagerRepo();
        if ($removeFile->removeFileFromStorage($file_path) == "success")
        {
            if ($this->deleteExpertingAnswer($id) == "success")
                return 'remove-success';
            return "path-delete-failed";
        }
        return 'remove-failed';
    }

    public function uploadFileForExpertingAnswer($experting_answer_id, $regiser_user_id, $doc_file)
    {
        if (DB::table("experting_answer_files")->where("experting_answer_id",$experting_answer_id)->exists())
        {
            $upload_file = new FileManagerRepo();
            if ($doc_file)
            {
                $result = $upload_file->insertFile($doc_file,$this->expertingAnswerImagePath.$experting_answer_id);
                if ($result["status"] == "ok")
                {
                    $expertingAnswerFile = new ExpertingAnswerFile();
                    $expertingAnswerFile -> path = $result["path"]."/".$result["filename"];
                    $expertingAnswerFile -> register_user_id = $regiser_user_id;
                    $expertingAnswerFile -> experting_answer_id = $experting_answer_id;
                    $expertingAnswerFile -> extension = $result["extension"];

                    if ($expertingAnswerFile->save())
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
        return ["status" => "expertingAnswer-notFound", "path" => null];

    }

    public function downloadFileOfExpertingAnswer($exp_id)
    {
        if (DB::table("experting_answer_files")->where("id",$exp_id)->exists())
        {
            $file_path_array = DB::table("experting_answer_files")->where("id", $exp_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->download($path);
            return "file-notFound";
        }
        return "notFound";
    }

    public function downloadBase64FileOfExpertingAnswer($exp_id)
    {
        if (DB::table("experting_answer_files")->where("id",$exp_id)->exists())
        {
            $file_path_array = DB::table("experting_answer_files")->where("id", $exp_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->getFileContentAsBase64($path);
            return "file-notFound";
        }
        return "notFound";
    }
}
