<?php

namespace App\Http\Controllers\Admin\Experting\PrivateExperting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\Experting\ExpertingAnswerRepo;
use App\Repository\Experting\PrivateExperting\PrivateExpertingQuestionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivateExpertingQuestionController extends Controller
{
    private $privateExpertingQuestionRepo;

    public function __construct(PrivateExpertingQuestionRepo $privateExpertingQuestionRepo)
    {
        $this->privateExpertingQuestionRepo = $privateExpertingQuestionRepo;
    }

    /////////////////////////Page
    public function showPageInfo($private_experting_id)
    {
        $result = $this->privateExpertingQuestionRepo->showPrivateExpertingPageInfo($private_experting_id);
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
                "category_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->privateExpertingQuestionRepo->insertPrivateExpertingQuestion(
                $request->title,
                $request->question,
                $request->status,
                $request->category_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingQuestionRepo->selectPrivateExpertingQuestionById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingQuestionRepo->selectAllPrivateExpertingQuestion()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingQuestionRepo->deletePrivateExpertingQuestion($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingQuestionRepo->restorePrivateExpertingQuestion($id)]);
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
                "category_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->privateExpertingQuestionRepo->updatePrivateExperting($id,
                $request->title,
                $request->question,
                $request->status,
                $request->category_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
