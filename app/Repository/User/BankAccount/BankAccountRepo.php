<?php

namespace App\Repository\User\BankAccount;

use App\Models\User\BankAccount\UserBankAccount;
use Illuminate\Support\Facades\DB;

class BankAccountRepo
{
    //////////////////////////////// Page
    public function showUserBankAccountPageInfo($user_id)
    {
        $pageInfo = [
            "user" => DB::table("users")->where("id",$user_id)->first(),
            "count" => 0,
            "bank_accounts" => []
        ];
        if (DB::table("user_bank_accounts")->where("user_id",$user_id)->exists())
        {
            $pageInfo["count"] = DB::table("user_bank_accounts")->where("user_id",$user_id)->count();
            $pageInfo["bank_accounts"]= UserBankAccount::withTrashed()->where("user_id",$user_id)->get();
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserBankAccount($bank, $title, $card_number,$sheba, $user_id)
    {
        if (!$this->checkExistsUserBankAccountByInfo($user_id,null,$card_number,$sheba))
        {
            $UserBankAccount = new UserBankAccount();
            $UserBankAccount->bank=$bank;
            $UserBankAccount->title=$title;
            $UserBankAccount->card_number=$card_number;
            $UserBankAccount->sheba=$sheba;
            $UserBankAccount->user_id=$user_id;
            return ($UserBankAccount->save())?
                ["status"=>"success","result"=>$UserBankAccount]
                :["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectUserBankAccountById($id)
    {
        if ($this->checkExistsUserBankAccountById($id))
            return UserBankAccount::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserBankAccount($user_id)
    {
        return $this->showUserBankAccountPageInfo($user_id);
    }

    public function deleteUserBankAccount($id)
    {
        if ($this->checkExistsUserBankAccountById($id))
        {
            if (DB::table("user_bank_accounts")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return (UserBankAccount::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }


    public function restoreUserBankAccount($id)
    {
        if ($this->checkExistsUserBankAccountById($id))
        {
            if (DB::table("user_bank_accounts")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return (UserBankAccount::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }


    public function updateUserBankAccount($id, $bank, $title, $card_number,$sheba, $user_id)
    {
        if ($this->checkExistsUserBankAccountById($id))
        {
            if (!$this->checkExistsUserBankAccountByInfo($user_id,$id,$card_number,$sheba))
            {
                $UserBankAccount = $this->selectUserBankAccountById($id);
                if ($title != null) $UserBankAccount->title=$title;
                if ($bank != null) $UserBankAccount->bank=$bank;
                if ($card_number != null) $UserBankAccount->card_number=$card_number;
                if ($sheba != null) $UserBankAccount->sheba=$sheba;
                if ($user_id != null) $UserBankAccount->user_id=$user_id;
                return ($UserBankAccount->save()) ? ["status" => "success"] : ["status" => "failed"];
            }
            return "duplicate";
        }
        return "notFound";
    }





    //////////////////////////////// Operation

    public function checkExistsUserBankAccountById($id)
    {
        return DB::table("user_bank_accounts")->where("id", "=", $id)->exists();
    }

    public function checkExistsUserBankAccountByInfo($user_id, $id=null, $card_number=null, $sheba=null)
    {
        if ($user_id==null) return true;
        if ($card_number==null && $sheba==null) return true;

        $userBankAccount=DB::table("user_bank_accounts")->where("user_id",$user_id);
        if ($id!=null) $userBankAccount->where("id","<>",$id);
        if ($card_number!=null) $userBankAccount->Where("card_number",$card_number);
        if ($sheba!=null) $userBankAccount->Where("sheba",$sheba);
        return $userBankAccount->exists();
    }

    //////////////////////////////// Relation


}
