<?php

namespace App\Repository\Experting\PublicExperting;


use App\Models\Experting\Experting\Experting;
use App\Models\Experting\PublicExperting\PublicExpertingAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PublicExpertingAnswerRepo
{

    ////////////////////////////// Page
    public function showPublicExpertingAnswerPageInfo($public_experting_id)
    {
        $pageInfo = [
            "count"=>0,
            "publicExpertingAnswers"=>null,
        ];
        if (PublicExpertingAnswer::where("public_experting_id", "=", $public_experting_id)->exists())
        {
            $publicExpertingAnswers = PublicExpertingAnswer::with(["public_experting", "experting_answers"])
                ->where("public_experting_id", "=", $public_experting_id)->get();

            $pageInfo["count"] = DB::table("public_experting_answers")
                ->where("public_experting_id", "=", $public_experting_id)
                ->count();

            foreach ($publicExpertingAnswers as $publicExpertingAnswer)
            {
                $pageInfo["publicExpertingAnswers"][] = [
                    "publicExpertingAnswer" => $publicExpertingAnswer
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPublicExpertingAnswer($answer, $status, $public_experting_id)
    {
        $publicExpertingAnswer = new PublicExpertingAnswer();
        $publicExpertingAnswer->answer=$answer;
        $publicExpertingAnswer->status=$status;
        $publicExpertingAnswer->public_experting_id=$public_experting_id;

        return ($publicExpertingAnswer->save())? ["status"=>"success","result"=>$publicExpertingAnswer]:["status"=>"failed"];
    }

    public function selectPublicExpertingAnswerById($id)
    {
        if ($this->checkExistsPublicExpertingAnswerById($id))
            return PublicExpertingAnswer::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPublicExpertingAnswer()
    {
        return (PublicExpertingAnswer::withTrashed()->get()->count()>0) ? PublicExpertingAnswer::withTrashed()->with(["public_experting", "experting_answers"])->get() : "notFound";
    }

    public function deletePublicExpertingAnswer($id)
    {
        if ($this->checkExistsPublicExpertingAnswerById($id))
        {
            if (DB::table("public_experting_answers")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Experting::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePublicExpertingAnswer($id)
    {
        if ($this->checkExistsPublicExpertingAnswerById($id))
        {
            if (DB::table("public_experting_answers")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Experting::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePublicExpertingAnswer($id, $answer, $status, $public_experting_id)
    {
        if ($this->checkExistsPublicExpertingAnswerById($id))
        {
            $publicExpertingAnswer = $this->selectPublicExpertingAnswerById($id);
            if ($answer != null) $publicExpertingAnswer->answer=$answer;
            if ($status != null) $publicExpertingAnswer->status=$status;
            if ($public_experting_id != null) $publicExpertingAnswer->public_experting_id=$public_experting_id;

            return ($publicExpertingAnswer->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPublicExpertingAnswerById($id)
    {
        return DB::table("public_experting_answers")->where("id", "=" , $id)->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
