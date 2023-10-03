<?php

namespace App\Http\Controllers\Admin\User\File;

use App\Http\Controllers\Controller;
use App\Repository\User\File\UserFileRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserFileController extends Controller
{
    private $userFileRepo;
    public function __construct(UserFileRepo $userFileRepo)
    {
        $this->userFileRepo=$userFileRepo;
    }

//    //////////////////////////////////////////page
//
//    public function showTaskPageInfo($user_id)
//    {
//        $result = $this->userTaskRepo->showUserTaskPageInfo($user_id);
//        return response()->json(["status"=>"ok","userTask"=>$result]);
//    }

    //////////////////////////////////////////crud

//    public function insertUserFile(Request $request)
//    {
//
//
//        if ($request->hasHeader("accept") && $request->header("accept") == "application/json")
//        {
//            $validator = Validator::make($request->all(), [
//                "title" => 'required|max:10',
//                "desc" => 'required',
//                "path" => 'nullable',
//                "user_id" => 'required',
//                "user_file_type_id" => 'nullable',
//                "doc_file" => 'nullable'
//            ]);
//            if ($validator->fails())
//                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
//            $validationRequest = $validator->validated();
//        }
//        else
//        {
//            $request->validate([
//                "title" => 'required|max:10',
//                "desc" => 'required',
//                "path" => 'nullable',
//                "user_id" => 'required',
//                "user_file_type_id" => 'nullable',
//                "doc_file" => 'nullable'
//            ]);
//        }
//        return  response()->json(["status" => $this->userFileRepo->insertUserFile(
//            $request->title ??null,
//            $request->desc ??null,
//            $request->path ??null,
//            $request->user_id ??null,
//            $request->user_file_type_id ??null,
//            $request->doc_file ??null,
//        )]);
//
//    }
//
//    public function selectUserFileById($id)
//    {
//        return response()->json(["status" => $this->userFileRepo->selectUserFileById($id)]);
//
//    }
//
//    public function updateUserFile($id, Request $request)
//    {
//        if ($request->hasHeader("accept") && $request->header("accept") == "application/json")
//        {
//            $validator = Validator::make($request->all(), [
//                "title" => 'required|max:10',
//                "desc" => 'required',
//                "path" => 'nullable',
//                "user_id" => 'required',
//                "user_file_type_id" => 'nullable',
//            ]);
//            if ($validator->fails())
//                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
//            $validationRequest = $validator->validated();
//        }
//        else
//        {
//            $request->validate([
//                "title" => 'required|max:10',
//                "desc" => 'required',
//                "path" => 'nullable',
//                "user_id" => 'required',
//                "user_file_type_id" => 'nullable',
//            ]);
//        }
//        return  response()->json(["status" => $this->userFileRepo->updateUserFile($id,
//            $request->title ??null,
//            $request->desc ??null,
//            $request->path ??null,
//            $request->user_id ??null,
//            $request->user_file_type_id ??null,
//        )]);
//
//    }

    public function deleteUserFile($id)
    {
        return response()->json(["status" => $this->userFileRepo->deleteUserFile($id)]);
    }

    //////////////////////////////////////////operation

    //////////////////////////////////////////file-operation

    public function getFilelistOfUserFile($user_id)
    {
        return response()->json(["status" => $this->userFileRepo->getFilelistOfUser($user_id)]);
    }

    public function removeFileFromUserFile($id)
    {
        return response()->json(["status" => $this->userFileRepo->removeFileFromUserFile($id)]);
    }

    public function uploadFileForUserFile($user_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "doc_file" => 'required|file',
                "uploader_user_id" => 'required'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->userFileRepo->uploadFileForUserFile($user_id,
                $request->title ??null,
                $request->uploader_user_id??null,
                $request->doc_file ??null
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function getFileOfUserFile($id)
    {
        return response()->json(["status" => $this->userFileRepo->getFileOfUserFile($id)]);
    }

    public function downloadFileOfUserAsBase64Format($file_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept")=="application/json" && \request()->ajax())
        {
            return response()->json(["status"=>$this->userFileRepo->getBase64DocOfUser($file_id)]);
        }
        return response()->json(["status"=>"refused"]);
    }
}
