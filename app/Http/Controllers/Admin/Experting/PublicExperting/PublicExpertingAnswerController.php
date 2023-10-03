<?php

namespace App\Http\Controllers\Admin\Experting\PublicExperting;

use App\Http\Controllers\Controller;
use App\Models\Experting\PublicExperting\PublicExpertingAnswer;
use App\Repository\Experting\PublicExperting\PublicExpertingAnswerRepo;
use App\Repository\Experting\PublicExperting\PublicExpertingQuestionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicExpertingAnswerController extends Controller
{
    private $publicExpertingAnswerRepo;

    public function __construct(PublicExpertingAnswerRepo $publicExpertingAnswerRepo)
    {
        $this->publicExpertingAnswerRepo = $publicExpertingAnswerRepo;
    }

    //////////////////////////Page
    public function showPageInfo($public_experting_id)
    {
        $result = $this->publicExpertingAnswerRepo->showPublicExpertingAnswerPageInfo($public_experting_id);
        return view("", compact("result"));
    }

    //////////////////////////CRUD
    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "answer" => 'required',
                "status" => 'nullable',
                "public_experting_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->publicExpertingAnswerRepo->insertPublicExpertingAnswer(
                $request->answer,
                $request->status,
                $request->public_experting_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingAnswerRepo->selectPublicExpertingAnswerById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingAnswerRepo->selectAllPublicExpertingAnswer()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingAnswerRepo->deletePublicExpertingAnswer($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingAnswerRepo->restorePublicExpertingAnswer($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "answer" => 'required',
                "status" => 'nullable',
                "public_experting_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->publicExpertingAnswerRepo->updatePublicExpertingAnswer($id,
                $request->answer,
                $request->status,
                $request->public_experting_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
