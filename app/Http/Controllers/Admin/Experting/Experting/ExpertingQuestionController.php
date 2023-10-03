<?php

namespace App\Http\Controllers\Admin\Experting\Experting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\Experting\ExpertingQuestionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpertingQuestionController extends Controller
{
    private $expertingQuestionRepo;

    public function __construct(ExpertingQuestionRepo $expertingQuestionRepo)
    {
        $this->expertingQuestionRepo = $expertingQuestionRepo;
    }

    ///////////////////////////////////Page
    public function showPageInfo($experting_id)
    {
        $result = $this->expertingQuestionRepo->showExpertingAnswerPageInfo($experting_id);
//        return view("", compact("result"));
        return $result;
    }

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "private_question_id" => 'nullable',
                "public_question_id" => 'nullable',
                "experting_id" => 'nullable',

            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->expertingQuestionRepo->insertExpertingQuestion(
                $request->private_question_id,
                $request->public_question_id,
                $request->experting_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingQuestionRepo->selectExpertingQuestionById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingQuestionRepo->selectAllExpertingQuestions()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingQuestionRepo->deleteExpertingQuestion($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingQuestionRepo->restoreExpertingQuestion($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "private_question_id" => 'nullable',
                "public_question_id" => 'nullable',
                "experting_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->expertingQuestionRepo->updateExpertingOption($id,
                $request->private_question_id,
                $request->public_question_id,
                $request->experting_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
