<?php

namespace App\Repository\Experting\PrivateExperting;


use App\Models\Experting\Experting\Experting;
use App\Models\Experting\PrivateExperting\PrivateExpertingAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrivateExpertingAnswerRepo
{

    ////////////////////////////// Page
    public function showPrivateExpertingPageInfo($privateExpertingQuestion_id)
    {
        $pageInfo = [
            "count"=>0,
            "privateExpertingAnswers"=>null,
        ];
        if (PrivateExpertingAnswer::where("private_experting_id", "=", $privateExpertingQuestion_id)->exists())
        {
            $privateExpertings = PrivateExpertingAnswer::with(["private_experting", "experting_answers"])
                ->where("private_experting_id", "=", $privateExpertingQuestion_id)->get();

            $pageInfo["count"] = DB::table("private_experting_answers")
                ->where("private_experting_id", "=", $privateExpertingQuestion_id)
                ->count();

            foreach ($privateExpertings as $privateExperting)
            {
                $pageInfo["privateExpertingAnswers"][] = [
                    "privateExpertingAnswer" => $privateExperting
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPrivateExpertingAnswer($answer, $status, $private_experting_id)
    {
        $privateExpertingAnswer = new PrivateExpertingAnswer();
        $privateExpertingAnswer->answer=$answer;
        $privateExpertingAnswer->status=$status;
        $privateExpertingAnswer->private_experting_id=$private_experting_id;


        return ($privateExpertingAnswer->save())? ["status"=>"success","result"=>$privateExpertingAnswer]:["status"=>"failed"];
    }

    public function selectPrivateExpertingAnswerById($id)
    {
        if ($this->checkExistsprivateExpertingAnswerById($id))
            return PrivateExpertingAnswer::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPrivateExpertingAnswer()
    {
        return (PrivateExpertingAnswer::withTrashed()->get()->count()>0) ? PrivateExpertingAnswer::withTrashed()->with(["private_experting", "experting_answers"])->get() : "notFound";
    }

    public function deletePrivateExpertingAnswer($id)
    {
        if ($this->checkExistsPrivateExpertingAnswerById($id))
        {
            if (DB::table("private_experting_answers")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return PrivateExpertingAnswer::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePrivateExpertingAnswer($id)
    {
        if ($this->checkExistsPrivateExpertingAnswerById($id))
        {
            if (DB::table("private_experting_answers")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return PrivateExpertingAnswer::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePrivateExpertingAnswer($id, $answer, $status, $private_experting_id)
    {
        if ($this->checkExistsprivateExpertingAnswerById($id))
        {
            $privateExpertingAnswer = $this->selectprivateExpertingAnswerById($id);
            if ($answer != null) $privateExpertingAnswer->answer=$answer;
            if ($status != null) $privateExpertingAnswer->status=$status;
            if ($private_experting_id != null) $privateExpertingAnswer->private_experting_id=$private_experting_id;

            return ($privateExpertingAnswer->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPrivateExpertingAnswerById($id)
    {
        return DB::table("private_experting_answers")->where("id", "=" , $id)->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
