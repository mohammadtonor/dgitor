<?php

namespace App\Repository\Experting\Experting;


use App\Models\Experting\Experting\Experting;
use App\Models\Location\City;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ExpertingRepo
{
    //////////////////////////////// Page
    public function showExpertingForUserPageInfo($user_id)
    {

        $pageInfo = [
            "count"=>0,
            "Expertings"=>null,
        ];
        if (Experting::where("register_user_id", "=", $user_id)->exists())
        {
            $Expertings = Experting::with(["register_user",
                                            "karshenas_user",
                                            "product",
                                            "answers",
                                            "experting_type"])
                ->where("register_user_id", "=", $user_id)
                ->get();

            $pageInfo["count"] = DB::table("Expertings")
                ->where("register_user_id", "=", $user_id)
                ->count();

            foreach ($Expertings as $Experting)
            {
                $pageInfo["Expertings"][] = [
                    "Experting" => $Experting
                ];
            }
        }
        return $pageInfo;
    }


    public function showExpertingForKarshenasPageInfo($user_id)
    {

        $pageInfo = [
            "count"=>0,
            "Expertings"=>null,
        ];
        if (Experting::where("karshenas_user_id", "=", $user_id)->exists())
        {
            $Expertings = Experting::with(["register_user",
                                            "karshenas_user",
                                            "product",
                                            "answers",
                                            "experting_type"])
                ->where("karshenas_user_id", "=", $user_id)
                ->get();

            $pageInfo["count"] = DB::table("Expertings")
                ->where("karshenas_user_id", "=", $user_id)
                ->count();

            foreach ($Expertings as $Experting)
            {
                $pageInfo["Expertings"][] = [
                    "Experting" => $Experting
                ];
            }
        }
        return $pageInfo;
    }
    //////////////////////////////// CRUD

    public function insertExperting($title, $product_id,
                                    $register_user_id,
                                    $karshenas_user_id,
                                    $type_id,
                                    $address, $postal_code, $city_id)
    {
        DB::beginTransaction();
        $experting = new Experting();
        $experting->title=$title;
        $experting->product_id=$product_id;
        $experting->register_user_id=$register_user_id;
        $experting->karshenas_user_id = $karshenas_user_id;
        $experting->type_id = $type_id;

        if ($experting->save())
        {
            $addr = new User\Address\UserAddress();
            $addr->title="karshenasi";
            $addr->postal_code=$postal_code;
            $addr->address=$address;
            $addr->city_id=$city_id;
            $addr->user_id=$register_user_id;
            $addr->save();

            DB::commit();
            return ["status"=>"success","result"=>$experting];
        }
        DB::rollBack();
        return ["status" => "failed"];
    }

    public function selectExpertingById($id)
    {
        if ($this->checkExistsExpertingById($id))
            return Experting::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExpertings()
    {
        return (Experting::withTrashed()->get()->count()>0) ?
            Experting::withTrashed()->with(["register_user",
                                            "karshenas_user",
                                            "product",
                                            "answers",
                                            "experting_type"])->get() : "notFound";
    }


    public function deleteExperting($id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if (DB::table("expertings")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Experting::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreExperting($id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if (DB::table("expertings")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Experting::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }


    public function updateExperting($id, $title, $product_id,
                                         $register_user_id,
                                         $karshenas_user_id,
                                         $type_id)
    {
        if ($this->checkExistsExpertingById($id))
        {
            if ($this->checkExistExpertingByTitle($id, $title))
            {
                $experting = $this->selectExpertingById($id);
                if ($title != null) $experting->title=$title;
                if ($product_id != null) $experting->product_id=$product_id;
                if ($register_user_id != null) $experting->register_user_id=$register_user_id;
                if ($karshenas_user_id != null) $experting->karshenas_user_id=$karshenas_user_id;
                if ($type_id != null) $experting->type_id=$type_id;

                return ($experting->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsExpertingById($id)
    {
        return DB::table("expertings")->where("id", "=" , $id)->exists();
    }

    public function checkExistExpertingByTitle($experting_id,$title=null)
    {
        if ($title==null)
            return true;

        $experting = DB::table("expertings");
        if ($experting_id!=null) $experting->where("id","<>",$experting_id);
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
