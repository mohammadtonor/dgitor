<?php

namespace App\Http\Controllers\Admin\Experting\PrivateExperting;

use App\Http\Controllers\Controller;
use App\Repository\Experting\PrivateExperting\PrivateExpertingAnswerRepo;
use App\Repository\Experting\PrivateExperting\PrivateExpertingQuestionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivateExpertingAnswerController extends Controller
{
    private $privateExpertingAnswerRepo;

    public function __construct(PrivateExpertingAnswerRepo $privateExpertingAnswerRepo)
    {
        $this->privateExpertingAnswerRepo = $privateExpertingAnswerRepo;
    }

    /////////////////////////////////Page
    public function showPageInfo($private_q_id)
    {
        $result = $this->privateExpertingAnswerRepo->showPrivateExpertingPageInfo($private_q_id);
        return view("", compact("result"));
    }

    /////////////////////////////////CRUD
    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "answer" => 'required',
                "status" => 'nullable',
                "private_experting_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json( $this->privateExpertingAnswerRepo->insertPrivateExpertingAnswer(
                $request->answer,
                $request->status,
                $request->private_experting_id,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingAnswerRepo->selectPrivateExpertingAnswerById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingAnswerRepo->selectAllPrivateExpertingAnswer()]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingAnswerRepo->deletePrivateExpertingAnswer($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->privateExpertingAnswerRepo->restorePrivateExpertingAnswer($id)]);
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
                "private_experting_id" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->privateExpertingAnswerRepo->updatePrivateExpertingAnswer($id,
                $request->answer,
                $request->status,
                $request->private_experting_id,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }
}
