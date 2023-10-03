<?php

namespace App\Http\Controllers\Admin\User\Madarek;

use App\Http\Controllers\Controller;
use App\Repository\User\Madarek\MadarekRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MadarekController extends Controller
{
    private $madarekRepo;

    public function __construct(MadarekRepo $madarekRepo)
    {
        $this->madarekRepo=$madarekRepo;
    }


    //////////////////////////////////////////crud

    public function selectById($id)
    {
        return response()->json(["status" => $this->madarekRepo->selectUserMadarekById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->madarekRepo->selectAllUserMadarek()]);
    }

    public function delete($id)
    {
        return response()->json(["status" => $this->madarekRepo->deleteUserMadarek($id)]);
    }

    public function restore($id)
    {
        return response()->json(["status" => $this->madarekRepo->restoreUserPhone($id)]);
    }

    public function getMadareklistOfUser($id)
    {
        return response()->json(["status" => $this->madarekRepo->getMadareklistOfUser($id)]);
    }

    public function removeMadarekFromUserMadarek($id)
    {
        return response()->json(["status" => $this->madarekRepo->removeMadarekFromUserMadarek($id)]);
    }

    public function upload($user_id, Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "uploader_user_id" => 'nullable',
                "doc_file" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->madarekRepo->uploadMadarekForUserMadarek($user_id,
                $request->title ??null,
                $request->uploader_user_id ??null,
                $request->doc_file ??null,
)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function getMadarekOfUserMadarek($id)
    {
        return response()->json(["status" => $this->madarekRepo->getMadarekOfUserMadarek($id)]);
    }

    public function downloadFileOfUserAsBase64Format($file_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept")=="application/json" && \request()->ajax())
        {
            return response()->json(["status"=>$this->madarekRepo->getBase64DocOfUser($file_id)]);
        }
        return response()->json(["status"=>"refused"]);
    }

}
