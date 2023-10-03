<?php

namespace App\Repository\Financial\TotalFin;

use App\Models\Financial\TotalFin\TotalFin;

class TotalFinsRepo
{

    /////////////////////////////////////page

    public function totalFinsShowPagrForUser($user_id)
    {
        return $this->selectTotalFinsOfUser($user_id);
    }

    /////////////////////////////////////crud

    public function createTOtalFinsForNewUser($user_id,$desc)
    {
        if (!$this->checkExistTotalFinsForUser($user_id))
        {
            $totalFins=new TotalFin();
            $totalFins->description=$desc;
            return $totalFins->save() ? ["status"=>"success" ,"result"=>$totalFins] : ["status"=>"failed"];
        }
        return ["status"=>"exists"];
    }


    public function selectTotalFinsOfUser($user_id)
    {
        if ($this->checkExistTotalFinsForUser($user_id))
        {
            return TotalFin::where("user_id",$user_id)->first();
        }
        return "notFound";
    }

    public function changeDescForUserTotalFins($user_id,$desc)
    {
        if ($this->checkExistTotalFinsForUser($user_id))
        {
            $totalFins=$this->selectTotalFinsOfUser($user_id);
            if ($desc!=null) $totalFins->description=$desc;
            return ($totalFins->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function update($total_purchase, $total_exchange, $total_periodic_service, $total_experting,
                            $etebar_naghdi_estefade, $mojodi_wallet, $mojodi_bon,
                            $sum_etebar_wallet_estefade, $sum_etebar_bon_estefade, $sum_trans_dargah,
                            $sum_esterdad, $sum_pouse, $sum_takhfif, $totalkharid, $pardakhti, $user_id)
    {
        if ($this->checkExistTotalFinsForUser($user_id))
        {
            $totlaFin = $this->selectTotalFinsOfUser($user_id);
            if ($total_purchase != null) $totlaFin->total_purchase=$total_purchase;
            if ($total_exchange != null) $totlaFin->total_exchange=$total_exchange;
            if ($total_periodic_service != null) $totlaFin->total_periodic_service=$total_periodic_service;
            if ($total_experting != null) $totlaFin->total_experting=$total_experting;
            if ($etebar_naghdi_estefade != null) $totlaFin->etebar_naghdi_estefade=$etebar_naghdi_estefade;
            if ($mojodi_wallet != null) $totlaFin->mojodi_wallet=$mojodi_wallet;
            if ($mojodi_bon != null) $totlaFin->mojodi_bon=$mojodi_bon;
            if ($sum_etebar_wallet_estefade != null) $totlaFin->sum_etebar_wallet_estefade=$sum_etebar_wallet_estefade;
            if ($sum_etebar_bon_estefade != null) $totlaFin->sum_etebar_bon_estefade=$sum_etebar_bon_estefade;
            if ($sum_trans_dargah != null) $totlaFin->sum_trans_dargah=$sum_trans_dargah;
            if ($sum_esterdad != null) $totlaFin->sum_esterdad=$sum_esterdad;
            if ($sum_pouse != null) $totlaFin->sum_pouse=$sum_pouse;
            if ($sum_takhfif != null) $totlaFin->sum_takhfif=$sum_takhfif;
            if ($totalkharid != null) $totlaFin->totalkharid=$totalkharid;
            if ($pardakhti != null) $totlaFin->pardakhti=$pardakhti;
            if ($user_id != null) $totlaFin->user_id=$user_id;
            return ($totlaFin->save()) ? "success" : "failed";
        }
        return "notFound";    }


    /////////////////////////////////////opetaion

    public function checkExistTotalFinsForUser($user_id)
    {
        return TotalFin::where("user_id",$user_id)->exists();
    }




    /////////////////////////////////////relation



}
