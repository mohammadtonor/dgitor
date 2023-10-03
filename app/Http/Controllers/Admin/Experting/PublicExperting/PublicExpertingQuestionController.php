<?php

namespace App\Http\Controllers\Admin\Experting\PublicExperting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\PrivateExperting\PrivateExpertingAnswerRepo;
use App\Repository\Experting\PublicExperting\PublicExpertingQuestionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicExpertingQuestionController extends Controller
{
    private $publicExpertingQuestionRepo;

    public function __construct(PublicExpertingQuestionRepo $publicExpertingQuestionRepo)
    {
        $this->publicExpertingQuestionRepo = $publicExpertingQuestionRepo;
    }

    ////////////////////////////Page

    public function showPageInfo($public_experting_id)
    {
        $result = $this->publicExpertingQuestionRepo->showpublicExpertingPageInfo($public_experting_id);
        return view("", compact("result"));
    }

    ////////////////////////////CRUD
    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "question" => 'nullable',
                "status" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->publicExpertingQuestionRepo->insertPublicExpertingQuestion(
                $request->title,
                $request->question,
                $request->status,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingQuestionRepo->selectPublicExpertingQuestionById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingQuestionRepo->selectAllPublicExpertingQuestions()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingQuestionRepo->deletePublicExpertingQuestion($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->publicExpertingQuestionRepo->restorePublicExpertingQuestion($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "question" => 'nullable',
                "status" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->publicExpertingQuestionRepo->updatePublicExperting($id,
                $request->title,
                $request->question,
                $request->status,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
