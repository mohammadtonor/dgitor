<?php

namespace App\Repository\Experting\PublicExperting;


use App\Models\Experting\Experting\Experting;
use App\Models\Experting\publicExperting\publicExpertingQuestion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PublicExpertingQuestionRepo
{

//    ////////////////////////////// Page
    public function showpublicExpertingPageInfo($public_experting_id)
    {
        $pageInfo = [
            "count"=>0,
            "publicExpertings"=>null,
        ];
        if (publicExpertingQuestion::where("id", "=", $public_experting_id)->exists())
        {
            $publicExpertings = publicExpertingQuestion::with(["experting_questions", "public_experting_answers"])
                ->where("id", "=", $public_experting_id)->get();

            $pageInfo["count"] = DB::table("public_experting_questions")
                ->where("id", "=", $public_experting_id)
                ->count();

            foreach ($publicExpertings as $publicExperting)
            {
                $pageInfo["publicExpertings"][] = [
                    "publicExperting" => $publicExperting
                ];
            }
        }
        return $pageInfo;
    }
    //////////////////////////////// CRUD

    public function insertPublicExpertingQuestion($title, $question, $status)
    {
        $publicExpertingQuestion = new PublicExpertingQuestion();
        $publicExpertingQuestion->title=$title;
        $publicExpertingQuestion->question=$question;
        $publicExpertingQuestion->status=$status;

        return ($publicExpertingQuestion->save())? ["status"=>"success","result"=>$publicExpertingQuestion]:["status"=>"failed"];
    }

    public function selectPublicExpertingQuestionById($id)
    {
        if ($this->checkExistsPublicExpertingQuestionById($id))
            return PublicExpertingQuestion::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPublicExpertingQuestions()
    {
        return (PublicExpertingQuestion::withTrashed()->get()->count()>0) ? PublicExpertingQuestion::withTrashed()->with(["experting_questions", "public_experting_answers"])->get() : "notFound";
    }

    public function deletePublicExpertingQuestion($id)
    {
        if ($this->checkExistsPublicExpertingQuestionById($id))
        {
            if (DB::table("public_experting_questions")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return PublicExpertingQuestion::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePublicExpertingQuestion($id)
    {
        if ($this->checkExistsPublicExpertingQuestionById($id))
        {
            if (DB::table("public_experting_questions")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return PublicExpertingQuestion::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePublicExperting($id, $title, $question, $status)
    {
        if ($this->checkExistsPublicExpertingQuestionById($id))
        {
            if (!$this->checkExistPublicExpertingQuestionByTitle($id, $title))
            {
                $publicExpertingQuestion = $this->selectPublicExpertingQuestionById($id);
                if ($title != null) $publicExpertingQuestion->title=$title;
                if ($question != null) $publicExpertingQuestion->question=$question;
                if ($status != null) $publicExpertingQuestion->status=$status;

                return ($publicExpertingQuestion->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPublicExpertingQuestionById($id)
    {
        return DB::table("public_experting_questions")->where("id", "=" , $id)->exists();
    }

    public function checkExistPublicExpertingQuestionByTitle($publicExperting_id,$title=null)
    {
        if ($title==null)
            return true;

        $publicExperting = DB::table("public_experting_questions");
        if ($publicExperting_id!=null) $publicExperting->where("id","<>",$publicExperting_id);
        if ($title!=null) $publicExperting->where("title",$title);
        return $publicExperting->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
