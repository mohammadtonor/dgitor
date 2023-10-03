<?php

namespace App\Repository\Financial\Bon;

use App\Models\Financial\Bon\UserBon;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserBonRepo
{
    //////////////////////////////// Page
    public function showBonPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "bons"=>null,
        ];
        if (UserBon::where("user_id", "=", $user_id)->exists())
        {
            $userBons = UserBon::where("user_id", "=", $user_id)->get();
            $pageInfo["count"] = DB::table("user_bons")->where("user_id", "=", $user_id)->count();
            foreach ($userBons as $userBon)
            {
                $pageInfo["bons"][] = [
                    "id" => $userBon->id,
                    "cost_trans" => $userBon->cost_trans,
                    "cost_final" => $userBon->cost_final,
                    "desc" => $userBon->description,
                    "date" => $userBon->checkTimeIsNull($userBon->created_at),
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserBon($desc,
                                   $cost_trans, $cost_final, $user_id)
    {
        $userBon = new UserBon();
        $userBon->desc=$desc;
        $userBon->cost_trans=$cost_trans;
        $userBon->cost_final=$cost_final;
        $userBon->user_id=$user_id;

        return ($userBon->save())? ["status"=>"success","result"=>$userBon]:["status"=>"failed"];
    }

    public function selectUserBonById($id)
    {
        if ($this->checkExistsUserBonById($id))
            return UserBon::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserBons()
    {
        return (UserBon::withTrashed()->get()->count()>0) ? UserBon::withTrashed()->get() : "notFound";
    }

    public function updateUserBon($id, $desc, $cost_trans, $cost_final, $user_id)
    {
        if ($this->checkExistsUserBonById($id))
        {
            $userBon = $this->selectUserBonById($id);
            if ($desc != null) $userBon->desc=$desc;
            if ($cost_trans != null) $userBon->cost_trans=$cost_trans;
            if ($cost_final != null) $userBon->cost_final=$cost_final;
            if ($user_id != null) $userBon->user_id=$user_id;

            return ($userBon->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteUserBon($id)
    {
        if ($this->checkExistsUserBonById($id))
            return UserBon::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsUserBonById($id)
    {
        return DB::table("user_bons")->where("id", "=" , $id)->exists();
    }

    public function checkExistsUserBonByTitle($UserBon_id, $title = null)
    {
        if ($title==null) return true;
        $UserBon=DB::table("user_bons");
        if ($title!=null) $UserBon->where("title",$title);
        if ($UserBon_id!=null) $UserBon->where("id","<>",$UserBon_id);
        return $UserBon->exists();
    }
    //////////////////////////////// Relation


    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
