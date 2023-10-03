<?php

namespace App\Http\Controllers\Admin\Exchange\PeriodicService\Pic;

use App\Http\Controllers\Controller;
use App\Repo\Permission\User\Task\UserTaskFileRepo;
use App\Repository\PeriodicService\Pic\PeriodicServicePicRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodicServicePicController extends Controller
{

    private $periodicServicePicRepo;
    public function __construct(PeriodicServicePicRepo $periodicServicePicRepo)
    {
        $this->periodicServicePicRepo=$periodicServicePicRepo;
    }
    public function removeFileFromPeriodicService($id)
    {
        return response()->json(["status" => $this->periodicServicePicRepo->removeFileFromPeriodicServicePic($id)]);
    }

    public function uploadFileForPeriodicService($periodic_service_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "doc_file" => 'required|file',
                "register_user_id" => 'required'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServicePicRepo->uploadFileForPeriodicServicePic($periodic_service_id,
                $request->register_user_id,
                $request->doc_file
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function getFileOfPeriodicService($id)
    {
        return response()->json(["status" => $this->periodicServicePicRepo->getFileOfPeriodicServicePic($id)]);
    }
}
