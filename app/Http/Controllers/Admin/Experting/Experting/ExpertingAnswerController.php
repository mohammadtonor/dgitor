<?php

namespace App\Http\Controllers\Admin\Experting\Experting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\Experting\ExpertingAnswerRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpertingAnswerController extends Controller
{
    private $expertingAnswerRepo;

    public function __construct(ExpertingAnswerRepo $expertingAnswerRepo)
    {
        $this->expertingAnswerRepo = $expertingAnswerRepo;
    }

    ///////////////////////////////////Page
    public function showPageInfo($experting_id)
    {
        $result = $this->expertingAnswerRepo->showExpertingAnswerPageInfo($experting_id);
        return view("", compact("result"));
    }

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "answer" => 'required',
                "public_experting_Answer_id" => 'nullable',
                "private_experting_Answer_id" => 'nullable',
                "experting_id" => 'nullable',
                "experting_question_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->expertingAnswerRepo->insertExpertingAnswer(
                $request->answer,
                $request->public_experting_Answer_id,
                $request->private_experting_Answer_id,
                $request->experting_id,
                $request->experting_question_id,

            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingAnswerRepo->selectExpertingAnswerById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingAnswerRepo->selectAllExpertingAnswers()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingAnswerRepo->deleteExpertingAnswer($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->expertingAnswerRepo->restoreExpertingAnswer($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "answer" => 'required',
                "public_experting_Answer_id" => 'nullable',
                "private_experting_Answer_id" => 'nullable',
                "experting_id" => 'nullable',
                "experting_question_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->expertingAnswerRepo->updateExpertingAnswer($id,
                $request->answer,
                $request->public_experting_Answer_id,
                $request->private_experting_Answer_id,
                $request->experting_id,
                $request->experting_question_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
