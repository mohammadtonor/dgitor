<?php

namespace App\Repository\Financial\Bon\BonTrans;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserBonTransRepo
{
    //////////////////////////////// Page
    public function showBonTransPageInfo($bon_id)
    {
        $pageInfo = [
            "count"=>0,
            "bonsTrans"=>null,
        ];
        if (UserBonTrans::where("user_bon_id", "=", $bon_id)->exists())
        {
            $userBons = UserBonTrans::with(["user_wallet","periodic_service_detail_fin_trans",
                "exchange_detail_fin_trans", "purchase_detail_fin_trans"])->where("user_bon_id", "=", $bon_id)->get();
            $pageInfo["count"] = DB::table("user_bon_trans")->where("user_bon_id", "=", $bon_id)->count();
            foreach ($userBons as $userBon)
            {
                $pageInfo["bonsTrans"][] = [
                    "bonsTran" => $userBon
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertUserBonTrans($title, $desc,
                                    $source_addr, $destination_addr,
                                    $user_bon_id, $purchase_detailfins_tran_id,
                                    $periodic_service_detailfins_tran_id,
                                    $exchange_detailfins_tran_id)
    {
        $userBonTrans = new UserBonTrans();
        $userBonTrans->title=$title;
        $userBonTrans->desc=$desc;
        $userBonTrans->source_addr=$source_addr;
        $userBonTrans->destination_addr=$destination_addr;
        $userBonTrans->user_bon_id=$user_bon_id;
        $userBonTrans->purchase_detailfins_tran_id=$purchase_detailfins_tran_id;
        $userBonTrans->periodic_service_detailfins_tran_id=$periodic_service_detailfins_tran_id;
        $userBonTrans->exchange_detailfins_tran_id=$exchange_detailfins_tran_id;
        return ($userBonTrans->save())? ["status"=>"success","result"=>$userBonTrans]:["status"=>"failed"];
    }

    public function selectUserBonTransById($id)
    {
        if ($this->checkExistsUserBonTransById($id))
            return UserBonTrans::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllUserBonsTrans()
    {
        return (UserBonTrans::withTrashed()->get()->count()>0) ? UserBonTrans::withTrashed()->get() : "notFound";
    }

    public function updateUserBon($id, $title, $desc,
                                       $source_addr, $destination_addr,
                                       $user_bon_id, $purchase_detailfins_tran_id,
                                       $periodic_service_detailfins_tran_id,
                                       $exchange_detailfins_tran_id)
    {
        if ($this->checkExistsUserBonTransById($id))
        {
            $userBonTrans = $this->selectUserBonTransById($id);
            if ($title != null) $userBonTrans->title=$title;
            if ($desc != null) $userBonTrans->desc=$desc;
            if ($source_addr != null) $userBonTrans->source_addr=$source_addr;
            if ($destination_addr != null) $userBonTrans->destination_addr=$destination_addr;
            if ($user_bon_id != null) $userBonTrans->user_bon_id=$user_bon_id;
            if ($purchase_detailfins_tran_id != null) $userBonTrans->purchase_detailfins_tran_id=$purchase_detailfins_tran_id;
            if ($periodic_service_detailfins_tran_id != null) $userBonTrans->periodic_service_detailfins_tran_id=$periodic_service_detailfins_tran_id;
            if ($exchange_detailfins_tran_id != null) $userBonTrans->exchange_detailfins_tran_id=$exchange_detailfins_tran_id;
            return ($userBonTrans->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteUserBonTrans($id)
    {
        if ($this->checkExistsUserBonTransById($id))
            return UserBonTrans::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsUserBonTransById($id)
    {
        return DB::table("user_bon_trans")->where("id", "=" , $id)->exists();
    }

    public function checkExistsUserBonTransByTitle($UserBonTrans_id, $title = null)
    {
        if ($title==null) return true;
        $UserBonTrans=DB::table("user_bon_trans");
        if ($title!=null) $UserBonTrans->where("title",$title);
        if ($UserBonTrans_id!=null) $UserBonTrans->where("id","<>",$UserBonTrans_id);
        return $UserBonTrans->exists();
    }
    //////////////////////////////// Relation


    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
