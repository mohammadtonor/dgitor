<?php

namespace App\Repository\PeriodicService\Pic;


use App\Models\PeriodicService\Pic\PeriodicServicePic;
use App\Repository\Utility\FileManagerRepo;
use Illuminate\Support\Facades\DB;

class PeriodicServicePicRepo
{
    public $periodicServicePic = "/image/PeriodicService/";


    public function deletePeriodicServicePic($id)
    {
        if ($this->checkExistsPeriodicServicePicById($id))
            return PeriodicServicePic::where("id",$id)->delete() ? "success" : "failed";
        return "periodicServicePic-notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPeriodicServicePicById($id)
    {
        return DB::table("periodic_service_pics")->where("id", "=" , $id)->exists();
    }

    //////////////file operation

    public function removeFileFromPeriodicServicePic($id)
    {
        $file_path = DB::table("periodic_service_pics")->where("id",$id)->first()->path;
        $removeFile = new FileManagerRepo();
        if ($removeFile->removeFileFromStorage($file_path) == "success")
        {
            if ($this->deletePeriodicServicePic($id) == "success")
                return 'remove-success';
            return "path-delete-failed";
        }
        return 'remove-failed';
    }

    public function uploadFileForPeriodicServicePic($periodic_service_id, $register_user_id, $doc_file)
    {
        if (DB::table("periodic_services")->where("id",$periodic_service_id)->exists())
        {
            $upload_file = new FileManagerRepo();
            if ($doc_file)
            {
                $result = $upload_file->insertFile($doc_file,$this->periodicServicePic.$periodic_service_id);
                if ($result["status"] == "ok")
                {
                    $userTaskFile = new PeriodicServicePic();
                    $userTaskFile -> path = $result["path"]."/".$result["filename"];
                    $userTaskFile -> periodic_service_id = $periodic_service_id;
                    $userTaskFile -> extension = $result["extension"];
                    $userTaskFile -> register_user_id = $register_user_id;

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
        return ["status" => "periodicService-notFound", "path" => null];

    }

    public function getFileOfPeriodicServicePic($productPic_id)
    {
        if (DB::table("periodic_service_pics")->where("id",$productPic_id)->exists())
        {
            $file_path_array = DB::table("periodic_service_pics")->where("id", $productPic_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->download($path);
            return "file-notFound";
        }
        return "notFound";
    }

    ////////////////////////////////////////relation

}
