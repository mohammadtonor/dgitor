<?php

namespace App\Repository\User\File;

class UserFileRepo
{
//    public $userFilePath = "/file/UserFile/";
//
//    //////////////////////////////// Page
//    public function showUserFilePageInfo()
//    {
//
//    }
//
//    //////////////////////////////// CRUD
//
//    // وارد کردن
//    public function insertUserFile($path, $user_id, $doc_file)
//    {
//        $userFile = new UserFile();
//        $userFile->path=$path;
//        $userFile->user_id=$user_id;
//        if ($userFile->save())
//        {
//            if (!is_null($doc_file))
//            {
//                $userFile_id= $userFile->id;
//                $uploadResult = $this->uploadFileForUserFile($userFile_id, $user_id, $doc_file)["status"];
//                if($uploadResult != "ok")
//                    return ["status"=>"upload-failed"];
//                return ["status"=>"upload-success","result"=>$userFile];
//            }
//            return ["status"=>"success","result"=>$userFile];
//        }
//        return ["status"=>"failed"];
//    }
//
//    // اتخاب با ایدی
//    public function selectUserFileById($id)
//    {
//        if ($this->checkExistsUserFileById($id))
//            return UserFile::where("id",$id)->first();
//        return "userFile-notFound";
//    }
//
//    // انتخاب همه
//    public function selectAllUserFile($id)
//    {
//        return (UserFile::all()->count()>0) ? UserFile::all() : "userFile-notFound";
//    }
//
//    // به روز رسانی
//    public function updateUserFile($id, $title, $desc, $path, $user_id)
//    {
//        if ($this->checkExistsUserFileById($id))
//        {
//            $userFile = $this->selectUserFileById($id);
//            if ($desc != null) $userFile->title=$title;
//            if ($desc != null) $userFile->description=$desc;
//            if ($path != null) $userFile->path=$path;
//            if ($user_id != null) $userFile->user_id=$user_id;
//
//            return ($userFile->save()) ? "success" : "failed";
//        }
//        return "userFile-notFound";
//    }
//
//    // حذف
//    public function deleteUserFile($id)
//    {
//        if ($this->checkExistsUserFileById($id))
//            return UserFile::where("id",$id)->delete() ? "success" : "failed";
//        return "userFile-notFound";
//    }
//
//    //////////////////////////////// Operation
//
//    // بررسی موجود بودن با ایدی
//    public function checkExistsUserFileById($id)
//    {
//        return (bool)UserFile::where("id",$id)->exists();
//    }
//
//    // بررسی موجود بودن با عنوان
//    public function checkExistsUserFileByTitle($title=null)
//    {
//        $userFile = DB::table("user_files");
//        if ($title != null) $userFile = $userFile->where("title", $title);
//        return $userFile->exists();
//    }
//
//    //////////////file operation
//
//    public function getFilelistOfUser($user_id)
//    {
//        if (DB::table("user_files")->where("user_id",$user_id)->exists())
//        {
//            return DB::table("user_files")->where("user_id",$user_id)->get();
//        }
//        return "notFound";
//    }
//
//    public function removeFileFromUserFile($id)
//    {
//        $file_path = DB::table("user_files")->where("id",$id)->first()->path;
//        $removeFile = new FileManagerRepo();
//        if ($removeFile->removeFileFromStorage($file_path) == "success")
//        {
//            if ($this->deleteUserFile($id))
//                return 'remove-success';
//            return "path-delete-failed";
//        }
//        return 'remove-failed';
//    }
//
//    public function uploadFileForUserFile($user_id, $title, $uploader_user_id, $doc_file)
//    {
//        if (DB::table("users")->where("id",$user_id)->exists())
//        {
//            $upload_file = new FileManagerRepo();
//            if ($doc_file)
//            {
//                $result = $upload_file->insertFile($doc_file,$this->userFilePath.$user_id);
//                if ($result["status"] == "ok")
//                {
//                    $userFile = new UserFile();
//                    $userFile -> title = $title;
//                    $userFile -> user_id = $user_id;
//                    $userFile -> uploader_user_id = $uploader_user_id;
//                    $userFile -> extension = $result["extension"];
//                    $userFile -> path = $result["path"]."/".$result["filename"];
//                    if ($userFile->save())
//                    {
//                        return [
//                            "status" => "success",
//                            "path" => $result["path"]."/".$result["filename"]
//                        ];
//                    }
//                }
//                return ["status" => "upload-failed", "file_path" => null];
//            }
//            return ["status" => "file-notExists", "file_path" => null];
//        }
//        return ["status" => "userFile-notFound", "file_path" => null];
//
//    }
//
//    public function getFileOfUserFile($userFile_id)
//    {
//        if (DB::table("user_files")->where("id",$userFile_id)->exists())
//        {
//            $file_path_array = DB::table("user_files")->where("id", $userFile_id)->first();
//            $path = $file_path_array->path;
//            $fileManager = new FileManagerRepo();
//            if ($path != null)
//                return $fileManager->download($path);
//            return "file-notFound";
//        }
//        return "notFound";
//    }
//
//    public function getBase64DocOfUser($userFile_id)
//    {
//        if (DB::table("user_files")->where("id",$userFile_id)->exists())
//        {
//            $file_path_array = DB::table("user_files")->where("id", $userFile_id)->first();
//            $path = $file_path_array->path;
//            $fileManager = new FileManagerRepo();
//            if ($path != null)
//                return $fileManager->getFileContentAsBase64($path);
//            return "file-notFound";
//        }
//        return "notFound";
//    }
}
