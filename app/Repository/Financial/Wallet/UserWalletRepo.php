<?php

namespace App\Repository\Financial\Wallet;

use App\Models\Financial\Wallet\UserWallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserWalletRepo
{
    //////////////////////////////// Page
    public function showUserWalletPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "userWallets"=>null,
        ];
        if (UserWallet::where("user_id", "=", $user_id)->exists())
        {
            $userWallets = UserWallet::with(["user"])->where("user_id", "=", $user_id)->get();
            $pageInfo["count"] = DB::table("user_wallets")->where("user_id", "=", $user_id)->count();
            foreach ($userWallets as $userWallet)
            {
                $pageInfo["userWallets"][] = [
                    "id" => $userWallet->id,
                    "cost_trans" => $userWallet->cost_trans,
                    "cost_final" => $userWallet->cost_final,
                    "desc" => $userWallet->description,
                    "date" => $userWallet->checkTimeIsNull($userWallet->created_at),
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserWallet($desc,
                                   $cost_trans, $cost_final, $user_id)
    {
        $userWallet = new UserWallet();
        $userWallet->desc=$desc;
        $userWallet->cost_trans=$cost_trans;
        $userWallet->cost_final=$cost_final;
        $userWallet->user_id=$user_id;

        return ($userWallet->save())? ["status"=>"success","result"=>$userWallet]:["status"=>"failed"];
    }

    public function selectUserWalletById($id)
    {
        if ($this->checkExistsUserWalletById($id))
            return UserWallet::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserWallets()
    {
        return (UserWallet::withTrashed()->get()->count()>0) ? UserWallet::withTrashed()->get() : "notFound";
    }

    public function updateUserWallet($id, $desc, $cost_trans, $cost_final, $user_id)
    {
        if ($this->checkExistsUserWalletById($id))
        {
            $userWallet = $this->selectUserWalletById($id);
            if ($desc != null) $userWallet->desc=$desc;
            if ($cost_trans != null) $userWallet->cost_trans=$cost_trans;
            if ($cost_final != null) $userWallet->cost_final=$cost_final;
            if ($user_id != null) $userWallet->user_id=$user_id;

            return ($userWallet->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteUserWallet($id)
    {
        if ($this->checkExistsUserWalletById($id))
            return UserWallet::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsUserWalletById($id)
    {
        return DB::table("user_wallets")->where("id", "=" , $id)->exists();
    }

    public function checkExistsUserWalletByTitle($userWallet_id, $title = null)
    {
        if ($title==null) return true;
        $userWallet=DB::table("user_wallets");
        if ($title!=null) $userWallet->where("title",$title);
        if ($userWallet_id!=null) $userWallet->where("id","<>",$userWallet_id);
        return $userWallet->exists();
    }
    //////////////////////////////// Relation


    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
