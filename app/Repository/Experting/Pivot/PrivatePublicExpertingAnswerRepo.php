<?php

namespace App\Repository\Experting\Pivot;


use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Pivot\PrivatePublicExpertingAnswer;
use App\Models\Experting\PublicExperting\PublicExpertingAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrivatePublicExpertingAnswerRepo
{
    //////////////////////////// CRUD
    public function insertPivot($desc, $private_question_id, $public_question_id, $experting_answer_id, $experting_id)
    {
        $pivot = new PrivatePublicExpertingAnswer();
        $pivot->desc=$desc;
        $pivot->private_question_id=$private_question_id;
        $pivot->public_question_id=$public_question_id;
        $pivot->experting_answer_id=$experting_answer_id;
        $pivot->experting_id=$experting_id;

        return ($pivot->save())? ["status"=>"success","result"=>$pivot]:["status"=>"failed"];
    }

    public function selectPivotById($id)
    {
        if ($this->checkExistsPivotById($id))
            return PrivatePublicExpertingAnswer::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPivot()
    {
        return (PrivatePublicExpertingAnswer::withTrashed()->get()->count()>0) ? PrivatePublicExpertingAnswer::withTrashed()->with(["public_experting", "experting_answers"])->get() : "notFound";
    }

    public function deletePivot($id)
    {
        if ($this->checkExistsPivotById($id))
        {
            if (DB::table("private_public_experting_answer")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Experting::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePivot($id)
    {
        if ($this->checkExistsPivotById($id))
        {
            if (DB::table("private_public_experting_answer")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return PrivatePublicExpertingAnswer::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePivot($id, $desc, $private_question_id, $public_question_id, $experting_answer_id, $experting_id)
    {
        if ($this->checkExistsPivotById($id))
        {
            $pivot = $this->selectPivotById($id);
            if ($desc != null) $pivot->desc=$desc;
            if ($private_question_id != null) $pivot->private_question_id=$private_question_id;
            if ($public_question_id != null) $pivot->public_question_id=$public_question_id;
            if ($experting_answer_id != null) $pivot->experting_answer_id=$experting_answer_id;
            if ($experting_id != null) $pivot->experting_id=$experting_id;

            return ($pivot->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPivotById($id)
    {
        return DB::table("private_public_experting_answer")->where("id", "=" , $id)->exists();
    }
}
