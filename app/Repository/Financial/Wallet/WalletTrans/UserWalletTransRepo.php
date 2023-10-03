<?php

namespace App\Repository\Financial\Wallet\WalletTrans;

use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserWalletTransRepo
{
    //////////////////////////////// Page
    public function showWalletTransPageInfo($wallet_id)
    {
        $pageInfo = [
            "count"=>0,
            "walletsTrans"=>null,
        ];
        if (UserWalletTrans::where("user_wallet_id", "=", $wallet_id)->exists())
        {
            $userWallets = UserWalletTrans::with(["user_wallet","periodic_service_detail_fin_trans",
                "exchange_detail_fin_trans", "purchase_detail_fin_trans"])
                ->where("user_Wallet_id", "=", $wallet_id)->get();
            $pageInfo["count"] = DB::table("user_wallet_trans")->where("user_Wallet_id", "=", $wallet_id)->count();
            foreach ($userWallets as $userWallet)
            {
                $pageInfo["walletsTrans"][] = [
                    "walletsTran" => $userWallet
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserWalletTrans($title, $desc,
                                    $source_addr, $destination_addr,
                                    $user_Wallet_id, $purchase_detailfins_tran_id,
                                    $periodic_service_detailfins_tran_id,
                                    $exchange_detailfins_tran_id)
    {
        $userWalletTrans = new UserWalletTrans();
        $userWalletTrans->title=$title;
        $userWalletTrans->desc=$desc;
        $userWalletTrans->source_addr=$source_addr;
        $userWalletTrans->destination_addr=$destination_addr;
        $userWalletTrans->user_Wallet_id=$user_Wallet_id;
        $userWalletTrans->purchase_detailfins_tran_id=$purchase_detailfins_tran_id;
        $userWalletTrans->periodic_service_detailfins_tran_id=$periodic_service_detailfins_tran_id;
        $userWalletTrans->exchange_detailfins_tran_id=$exchange_detailfins_tran_id;
        return ($userWalletTrans->save())? ["status"=>"success","result"=>$userWalletTrans]:["status"=>"failed"];
    }

    public function selectUserWalletTransById($id)
    {
        if ($this->checkExistsUserWalletTransById($id))
            return UserWalletTrans::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserWalletsTrans()
    {
        return (UserWalletTrans::withTrashed()->get()->count()>0) ? UserWalletTrans::withTrashed()->get() : "notFound";
    }

    public function updateUserWallet($id, $title, $desc,
                                       $source_addr, $destination_addr,
                                       $user_Wallet_id, $purchase_detailfins_tran_id,
                                       $periodic_service_detailfins_tran_id,
                                       $exchange_detailfins_tran_id)
    {
        if ($this->checkExistsUserWalletTransById($id))
        {
            $userWalletTrans = $this->selectUserWalletTransById($id);
            if ($title != null) $userWalletTrans->title=$title;
            if ($desc != null) $userWalletTrans->desc=$desc;
            if ($source_addr != null) $userWalletTrans->source_addr=$source_addr;
            if ($destination_addr != null) $userWalletTrans->destination_addr=$destination_addr;
            if ($user_Wallet_id != null) $userWalletTrans->user_Wallet_id=$user_Wallet_id;
            if ($purchase_detailfins_tran_id != null) $userWalletTrans->purchase_detailfins_tran_id=$purchase_detailfins_tran_id;
            if ($periodic_service_detailfins_tran_id != null) $userWalletTrans->periodic_service_detailfins_tran_id=$periodic_service_detailfins_tran_id;
            if ($exchange_detailfins_tran_id != null) $userWalletTrans->exchange_detailfins_tran_id=$exchange_detailfins_tran_id;
            return ($userWalletTrans->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteUserWalletTrans($id)
    {
        if ($this->checkExistsUserWalletTransById($id))
            return UserWalletTrans::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsUserWalletTransById($id)
    {
        return DB::table("user_wallet_trans")->where("id", "=" , $id)->exists();
    }

    public function checkExistsUserWalletTransByTitle($UserWalletTrans_id, $title = null)
    {
        if ($title==null) return true;
        $UserWalletTrans=DB::table("user_wallet_trans");
        if ($title!=null) $UserWalletTrans->where("title",$title);
        if ($UserWalletTrans_id!=null) $UserWalletTrans->where("id","<>",$UserWalletTrans_id);
        return $UserWalletTrans->exists();
    }
    //////////////////////////////// Relation


    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
