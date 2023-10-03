<?php

namespace App\Repository\Experting\Experting;

use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Experting\ExpertingAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpertingAnswerRepo
{
    //////////////////////////////// Page
    public function showExpertingAnswerPageInfo($experting_id)
    {
        $pageInfo = [
            "count"=>0,
            "expertingAnswers"=>null,
        ];
        if (ExpertingAnswer::where("experting_id", "=", $experting_id)->exists())
        {
            $expertingAnswers = ExpertingAnswer::with(["experting", "files", "private_answer", "public_answer", "experting_question"])
                ->where("experting_id", "=", $experting_id)->get();

            $pageInfo["count"] = DB::table("ExpertingAnswers")
                ->where("experting_id", "=", $experting_id)
                ->count();

            foreach ($expertingAnswers as $expertingAnswer)
            {
                $pageInfo["expertingAnswers"][] = [
                    "expertingAnswer" => $expertingAnswer
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertExpertingAnswer($answer,
                                    $public_experting_Answer_id,
                                    $private_experting_Answer_id,
                                    $experting_id, $experting_question_id)
    {
        $expertingAnswer = new ExpertingAnswer();
        $expertingAnswer->answer=$answer;
        $expertingAnswer->public_experting_Answer_id=$public_experting_Answer_id;
        $expertingAnswer->private_experting_Answer_id=$private_experting_Answer_id;
        $expertingAnswer->experting_id=$experting_id;
        $expertingAnswer->experting_question_id=$experting_question_id;

        return ($expertingAnswer->save())? ["status"=>"success","result"=>$expertingAnswer]:["status"=>"failed"];
    }

    public function selectExpertingAnswerById($id)
    {
        if ($this->checkExistsExpertingAnswerById($id))
            return ExpertingAnswer::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExpertingAnswers()
    {
        return (ExpertingAnswer::withTrashed()->get()->count()>0) ? ExpertingAnswer::withTrashed()->with(["experting", "files", "private_answer", "public_answer", "experting_question"])->get() : "notFound";
    }

    public function deleteExpertingAnswer($id)
    {
        if ($this->checkExistsExpertingAnswerById($id))
        {
            if (DB::table("experting_answers")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ExpertingAnswer::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreExpertingAnswer($id)
    {
        if ($this->checkExistsExpertingAnswerById($id))
        {
            if (DB::table("experting_answers")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return ExpertingAnswer::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }
    public function updateExpertingAnswer($id, $answer,
                                               $public_experting_Answer_id,
                                               $private_experting_Answer_id,
                                               $experting_id, $experting_question_id)
    {
        if ($this->checkExistsExpertingAnswerById($id))
        {
            $expertingAnswer = $this->selectExpertingAnswerById($id);
            if ($answer != null) $expertingAnswer->answer=$answer;
            if ($public_experting_Answer_id != null) $expertingAnswer->public_experting_Answer_id=$public_experting_Answer_id;
            if ($private_experting_Answer_id != null) $expertingAnswer->private_experting_Answer_id=$private_experting_Answer_id;
            if ($experting_id != null) $expertingAnswer->experting_id=$experting_id;
            if ($experting_question_id != null) $expertingAnswer->experting_question_id=$experting_question_id;

            return ($expertingAnswer->save()) ? "success" : "failed";
        }
        return "notFound";
    }


    //////////////////////////////// Operation

    public function checkExistsExpertingAnswerById($id)
    {
        return DB::table("experting_Answers")->where("id", "=" , $id)->exists();
    }

    public function checkExistExpertingAnswerByTitle($ExpertingAnswer_id,$title=null)
    {
        if ($title==null)
            return true;

        $ExpertingAnswer = DB::table("experting_Answers");
        if ($ExpertingAnswer_id!=null) $ExpertingAnswer->where("id","<>",$ExpertingAnswer_id);
        if ($title!=null) $ExpertingAnswer->where("title",$title);
        return $ExpertingAnswer->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
