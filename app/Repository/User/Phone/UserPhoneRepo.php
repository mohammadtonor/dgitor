<?php

namespace App\Repository\User\Phone;

use App\Models\User\Phone\UserPhone;
use Illuminate\Support\Facades\DB;

class UserPhoneRepo
{
    //////////////////////////////// Page
    public function showUserPhonePageInfo($user_id)
    {
        $pageInfo = [
            "user" => DB::table("users")->where("id",$user_id)->first(),
            "count" => 0,
            "tells" => []
        ];
        if (DB::table("user_phones")->where("user_id",$user_id)->exists())
        {
            $pageInfo["count"] = DB::table("user_phones")->where("user_id",$user_id)->count();
            $pageInfo["tells"]= UserPhone::withTrashed()->where("user_id",$user_id)->get();
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserPhone($title, $phone,$user_id)
    {
        $UserPhone = new UserPhone();
        $UserPhone->title=$title;
        $UserPhone->phone=$phone;
        $UserPhone->user_id=$user_id;
        return ($UserPhone->save())?
            ["status"=>"success","result"=>$UserPhone]:
            ["status"=>"failed"];

    }

    public function selectUserPhoneById($id)
    {
        if ($this->checkExistsUserPhoneById($id))
            return UserPhone::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserPhone($user_id)
    {
        return $this->showUserPhonePageInfo($user_id);
    }


    public function deleteUserPhone($id)
    {
        if ($this->checkExistsUserPhoneById($id)) {
            if (DB::table("user_phones")->where("id", $id)->whereNull("deleted_at")->exists()) {
                return (UserPhone::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }


    public function restoreUserPhone($id)
    {
        if ($this->checkExistsUserPhoneById($id)) {
            if (DB::table("user_phones")->where("id", $id)->whereNotNull("deleted_at")->exists()){
                return (UserPhone::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateUserPhone($id, $title, $phone)
    {
        if ($this->checkExistsUserPhoneById($id))
        {
            $UserPhone = $this->selectUserPhoneById($id);
            if ($title != null) $UserPhone->title=$title;
            if ($phone != null) $UserPhone->phone=$phone;
            return ($UserPhone->save()) ? "success" : "failed";
        }
        return "notFound";
    }



    //////////////////////////////// Operation

    public function checkExistsUserPhoneById($id)
    {
        return DB::table("user_phones")->where("id", "=", $id)->exists();
    }


    //////////////////////////////// Relation


}
