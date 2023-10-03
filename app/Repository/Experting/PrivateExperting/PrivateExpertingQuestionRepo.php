<?php

namespace App\Repository\Experting\PrivateExperting;


use App\Models\Experting\Experting\ExpertingAnswer;
use App\Models\Experting\PrivateExperting\PrivateExpertingQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrivateExpertingQuestionRepo
{

    ////////////////////////////// Page
    public function showPrivateExpertingPageInfo($private_experting_id)
    {
        $pageInfo = [
            "count"=>0,
            "privateExpertings"=>null,
        ];
        if (PrivateExpertingQuestion::where("id", "=", $private_experting_id)->exists())
        {
            $privateExpertings = PrivateExpertingQuestion::with(["experting_questions", "category", "private_experting_answers"])
                ->where("id", "=", $private_experting_id)->get();

            $pageInfo["count"] = DB::table("private_experting_questions")
                ->where("id", "=", $private_experting_id)
                ->count();

            foreach ($privateExpertings as $privateExperting)
            {
                $pageInfo["privateExpertings"][] = [
                    "privateExperting" => $privateExperting
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPrivateExpertingQuestion($title, $question, $status, $category_id)
    {
        $privateExperting = new PrivateExpertingQuestion();
        $privateExperting->title=$title;
        $privateExperting->question=$question;
        $privateExperting->status=$status;
        $privateExperting->category_id=$category_id;

        return ($privateExperting->save())? ["status"=>"success","result"=>$privateExperting]:["status"=>"failed"];
    }

    public function selectPrivateExpertingQuestionById($id)
    {
        if ($this->checkExistsPrivateExpertingQuestionById($id))
            return PrivateExpertingQuestion::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPrivateExpertingQuestion()
    {
        return (PrivateExpertingQuestion::withTrashed()->get()->count()>0) ? PrivateExpertingQuestion::withTrashed()->with(["experting_questions", "category", "private_experting_answers"])->get() : "notFound";
    }

    public function deletePrivateExpertingQuestion($id)
    {
        if ($this->checkExistsPrivateExpertingQuestionById($id))
        {
            if (DB::table("private_experting_questions")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return PrivateExpertingQuestion::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePrivateExpertingQuestion($id)
    {
        if ($this->checkExistsPrivateExpertingQuestionById($id))
        {
            if (DB::table("v")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return PrivateExpertingQuestion::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePrivateExperting($id, $title, $question, $status, $category_id)
    {
        if ($this->checkExistsprivateExpertingQuestionById($id))
        {
            $privateExpertingQuestion = $this->selectPrivateExpertingQuestionById($id);
            if ($title != null) $privateExpertingQuestion->title=$title;
            if ($question != null) $privateExpertingQuestion->question=$question;
            if ($status != null) $privateExpertingQuestion->status=$status;
            if ($category_id != null) $privateExpertingQuestion->category_id=$category_id;
            return ($privateExpertingQuestion->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPrivateExpertingQuestionById($id)
    {
        return DB::table("private_experting_questions")->where("id", "=" , $id)->exists();
    }

    public function checkExistPrivateExpertingQuestionByTitle($privateExperting_id,$title=null)
    {
        if ($title==null)
            return true;

        $privateExperting = DB::table("private_experting_questions");
        if ($privateExperting_id!=null) $privateExperting->where("id","<>",$privateExperting_id);
        if ($title!=null) $privateExperting->where("title",$title);
        return $privateExperting->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
