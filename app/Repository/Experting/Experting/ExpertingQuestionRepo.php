<?php

namespace App\Repository\Experting\Experting;

use App\Models\Experting\Experting\ExpertingQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpertingQuestionRepo
{
    //////////////////////////////// Page
    public function showExpertingAnswerPageInfo($experting_id)
    {
        $pageInfo = [
            "count"=>0,
            "expertingQuestions"=>null,
        ];
        if (ExpertingQuestion::where("experting_id", "=", $experting_id)->exists())
        {
            $expertingQuestions = ExpertingQuestion::with(["private_question", "public_question", "experting", "experting_answers"])
                ->where("experting_id", "=", $experting_id)->get();

            $pageInfo["count"] = DB::table("experting_questions")
                ->where("experting_id", "=", $experting_id)
                ->count();

            foreach ($expertingQuestions as $expertingQuestion)
            {
                $pageInfo["expertingQuestions"][] = [
                    "expertingQuestion" => $expertingQuestion
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertExpertingQuestion($private_question_id, $public_question_id, $experting_id)
    {
        $expertingQuestion = new ExpertingQuestion();
        $expertingQuestion->private_question_id=$private_question_id;
        $expertingQuestion->public_question_id=$public_question_id;
        $expertingQuestion->experting_id=$experting_id;

        return ($expertingQuestion->save())? ["status"=>"success","result"=>$expertingQuestion]:["status"=>"failed"];
    }

    public function selectExpertingQuestionById($id)
    {
        if ($this->checkExistsExpertingQuestionById($id))
            return ExpertingQuestion::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExpertingQuestions()
    {
        return (ExpertingQuestion::withTrashed()->get()->count()>0) ? ExpertingQuestion::withTrashed()->with(["private_question",
                                                                                                            "public_question",
                                                                                                            "experting",
                                                                                                            "experting_answers"])->get() : "notFound";
    }

    public function deleteExpertingQuestion($id)
    {
        if ($this->checkExistsExpertingQuestionById($id))
        {
            if (DB::table("experting_questions")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ExpertingQuestion::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreExpertingQuestion($id)
    {
        if ($this->checkExistsExpertingQuestionById($id))
        {
            if (DB::table("experting_questions")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return ExpertingQuestion::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }
    public function updateExpertingOption($id, $private_question_id, $public_question_id, $experting_id)
    {
        if ($this->checkExistsExpertingQuestionById($id))
        {
            $expertingQuestion = $this->selectExpertingQuestionById($id);
            if ($private_question_id != null) $expertingQuestion->private_question_id=$private_question_id;
            if ($public_question_id != null) $expertingQuestion->public_question_id=$public_question_id;
            if ($experting_id != null) $expertingQuestion->experting_id=$experting_id;

            return ($expertingQuestion->save()) ? "success" : "failed";
        }
        return "notFound";
    }


    //////////////////////////////// Operation

    public function checkExistsExpertingQuestionById($id)
    {
        return DB::table("experting_questions")->where("id", "=" , $id)->exists();
    }

    public function checkExistExpertingQuestionByTitle($ExpertingQuestion_id,$title=null)
    {
        if ($title==null)
            return true;

        $ExpertingQuestion = DB::table("experting_questions");
        if ($ExpertingQuestion_id!=null) $ExpertingQuestion->where("id","<>",$ExpertingQuestion_id);
        if ($title!=null) $ExpertingQuestion->where("title",$title);
        return $ExpertingQuestion->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
