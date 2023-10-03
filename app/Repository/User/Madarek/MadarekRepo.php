<?php

namespace App\Repository\User\Madarek;

class MadarekRepo
{
    public $userMadarekPath = "/doc/User/";



    //////////////////////////////// CRUD


//    // اتخاب با ایدی
//    public function selectUserMadarekById($id)
//    {
//        if ($this->checkExistsUserMadarekById($id))
//            return Madarek::withTrashed()->where("id",$id)->first();
//        return "notFound";
//    }
//
//    // انتخاب همه
//    public function selectAllUserMadarek()
//    {
//        return (Madarek::withTrashed()->get()->count()>0) ? Madarek::withTrashed()->get() : "notFound";
//    }
//
//
//
//    // حذف
//    public function deleteUserMadarek($id)
//    {
//        if ($this->checkExistsUserMadarekById($id)) {
//            if (DB::table("user_madareks")->where("id", $id)->whereNull("deleted_at")->exists()) {
//                return (Madarek::where("id", $id)->delete()) ? "success" : "failed";
//            }
//            return "deleted";
//        }
//        return "notFound";
//    }
//
//    public function restoreUserPhone($id)
//    {
//        if ($this->checkExistsUserMadarekById($id)) {
//            if (DB::table("user_madareks")->where("id", $id)->whereNotNull("deleted_at")->exists()){
//                return (Madarek::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
//            }
//            return "notDeleted";
//        }
//        return "notFound";
//    }
//
//    //////////////////////////////// Operation
//
//    // بررسی موجود بودن با ایدی
//    public function checkExistsUserMadarekById($id)
//    {
//        return DB::table("user_madareks")->where("id", "=", $id)->exists();
//    }
//
//    //////////////file operation
//
//    public function getMadareklistOfUser($user_id)
//    {
//        if (DB::table("user_madareks")->where("user_id",$user_id)->exists())
//        {
//            return DB::table("user_madareks")->where("user_id",$user_id)->get();
//        }
//        return "notFound";
//    }
//
//    public function removeMadarekFromUserMadarek($id)
//    {
//        $Madarek_path = DB::table("user_madareks")->where("id",$id)->first()->path;
//        $removeMadarek = new FileManagerRepo();
//        if ($removeMadarek->removeFileFromStorage($Madarek_path) == "success")
//        {
//            if ($this->deleteUserMadarek($id))
//                return 'remove-success';
//            return "path-delete-failed";
//        }
//        return 'remove-failed';
//    }
//
//    public function uploadMadarekForUserMadarek($user_id, $title, $uploader_user_id, $doc_file)
//    {
//        if (DB::table("users")->where("id",$user_id)->exists())
//        {
//            $upload_Madarek = new FileManagerRepo();
//            if ($doc_file)
//            {
//                $result = $upload_Madarek->insertFile($doc_file,$this->userMadarekPath.$user_id);
//                if ($result["status"] == "ok")
//                {
//                    $userMadarek = new Madarek();
//                    $userMadarek -> title = $title;
//                    $userMadarek -> user_id = $user_id;
//                    $userMadarek -> uploader_user_id = $uploader_user_id;
//                    $userMadarek -> extension = $result["extension"];
//                    $userMadarek -> path = $result["path"]."/".$result["filename"];
//                    if ($userMadarek->save())
//                    {
//                        return [
//                            "status" => "success",
//                            "path" => $result["path"]."/".$result["filename"]
//                        ];
//                    }
//                }
//                return ["status" => "upload-failed", "filename" => null];
//            }
//            return ["status" => "madarek-notExists", "filename" => null];
//        }
//        return ["status" => "userMadarek-notFound", "filename" => null];
//
//    }
//
//    public function getMadarekOfUserMadarek($madarek_id)
//    {
//        if (DB::table("user_Madareks")->where("id",$madarek_id)->exists())
//        {
//            $Madarek_path_array = DB::table("user_Madareks")->where("id", $madarek_id)->first();
//            $path = $Madarek_path_array->path;
//            $MadarekManager = new FileManagerRepo();
//            if ($path != null)
//                return $MadarekManager->download($path);
//            return "Madarek-notFound";
//        }
//        return "notFound";
//    }
//
//
//    public function getBase64DocOfUser($madarek_id)
//    {
//        if (DB::table("user_madareks")->where("id",$madarek_id)->exists())
//        {
//            $file_path_array = DB::table("user_madareks")->where("id", $madarek_id)->first();
//            $path = $file_path_array->path;
//            $fileManager = new FileManagerRepo();
//            if ($path != null)
//                return $fileManager->getFileContentAsBase64($path);
//            return "file-notFound";
//        }
//        return "notFound";
//    }


}
