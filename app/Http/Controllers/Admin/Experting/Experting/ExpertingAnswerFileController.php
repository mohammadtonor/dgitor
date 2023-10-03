<?php

namespace App\Http\Controllers\Admin\Experting\Experting;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\CategoryImageFileRepo;
use App\Repository\Experting\Experting\ExpertingAnswerFileRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpertingAnswerFileController extends Controller
{
    private $expertingAnswerFileRepo;


    public function __construct(ExpertingAnswerFileRepo $expertingAnswerFileRepo)
    {
        $this->expertingAnswerFileRepo=$expertingAnswerFileRepo;
    }

    //////////////////////////////////////////////crud


    public function removeFileFromExpertingAnswerFile($id)
    {
        if (request()->hasHeader("accept") && request()->header("accept")=="application/json" && request()->ajax())
        {
            return response()->json(["status"=>$this->expertingAnswerFileRepo->removeFileFromExpertingAnswer($id)]);
        }
        return response()->json(["status"=>"refused"]);
    }

    public function uploadFileForExpertingAnswerFile($experting_answer_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept")=="application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "doc_file" => 'required|image|size:1024||dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]);

            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return  response()->json(["status" => $this->expertingAnswerFileRepo->uploadFileForExpertingAnswer($experting_answer_id,
                $request->regiser_user_id,
                $request->doc_file)]);

        }
        return response()->json(["status"=>"refused"]);
    }

    public function downloadFileOfExpertingAnswerFile($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept")=="application/json" && \request()->ajax())
        {
            return response()->json(["status"=>$this->expertingAnswerFileRepo->downloadFileOfExpertingAnswer($id)]);
        }
        return response()->json(["status"=>"refused"]);
    }

    public function downloadBase64FileOfExpertingAnswerFile($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept")=="application/json" && \request()->ajax())
        {
            return response()->json(["status"=>$this->expertingAnswerFileRepo->downloadBase64FileOfExpertingAnswer($id)]);
        }
        return response()->json(["status"=>"refused"]);
    }
}
