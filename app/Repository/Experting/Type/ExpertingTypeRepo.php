<?php

namespace App\Repository\Experting\Type;


use App\Models\Experting\Experting\Experting;
use App\Models\Experting\Type\ExpertingType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExpertingTypeRepo
{

    //////////////////////////////// CRUD

    public function insertExpertingType($title, $cost, $is_tasvie,
                                    $experting_time,
                                    $category_id)
    {
        $expertingType = new Experting();
        $expertingType->title=$title;
        $expertingType->cost = $cost;
        $expertingType->is_tasvie=$is_tasvie;
        $expertingType->experting_time=$experting_time;
        $expertingType->category_id=$category_id;

        return ($expertingType->save())? ["status"=>"success","result"=>$expertingType]:["status"=>"failed"];
    }

    public function selectExpertingById($id)
    {
        if ($this->checkExistsExpertingById($id))
            return ExpertingType::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExpertingTypes()
    {
        return (ExpertingType::withTrashed()->get()->count()>0) ? ExpertingType::withTrashed()->with(["category", "expertings"])->get() : "notFound";
    }

    public function deleteExpertingTypes($id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if (DB::table("experting_types")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ExpertingType::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreExpertingTypes($id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if (DB::table("experting_types")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return ExpertingType::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateExpertingType($id, $title, $cost, $is_tasvie,
                                         $experting_time,
                                         $category_id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if (!$this->checkExistExpertingByTitle($id, $title))
            {
                $expertingType = $this->selectExpertingById($id);
                if ($title != null) $expertingType->title=$title;
                if ($cost != null) $expertingType->cost=$cost;
                if ($is_tasvie != null) $expertingType->is_tasvie=$is_tasvie;
                if ($experting_time != null) $expertingType->experting_time=$experting_time;
                if ($category_id != null) $expertingType->category_id=$category_id;

                return ($expertingType->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsExpertingById($id)
    {
        return DB::table("experting_types")->where("id", "=" , $id)->exists();
    }

    public function checkExistExpertingByTitle($expertingType_id,$title=null)
    {
        if ($title==null)
            return true;

        $experting = DB::table("experting_types");
        if ($expertingType_id!=null) $experting->where("id","<>",$expertingType_id);
        if ($title!=null) $experting->where("title",$title);
        return $experting->exists();
    }

    //////////////////////////////// Relation



    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
