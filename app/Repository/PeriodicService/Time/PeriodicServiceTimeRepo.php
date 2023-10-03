<?php

namespace App\Repository\PeriodicService\Time;

use App\Models\PeriodicService\Time\PeriodiceServiceTime;
use Illuminate\Support\Facades\DB;

class PeriodicServiceTimeRepo
{


    //////////////////////////////// CRUD

    public function insertPeriodicServiceTime($start_contract_time, $start_time, $periodic_time,
                                      $how_long, $periodic_service_id)
    {
        $periodicServiceTime = new PeriodiceServiceTime();
        $periodicServiceTime->start_contract_time=$start_contract_time;
        $periodicServiceTime->start_time=$start_time;
        $periodicServiceTime->periodic_time=$periodic_time;
        $periodicServiceTime->how_long=$how_long;
        $periodicServiceTime->periodic_service_id=$periodic_service_id;
        return ($periodicServiceTime->save())? ["status"=>"success","result"=>$periodicServiceTime]:["status"=>"failed"];
    }

    public function selectPeriodicServiceTimeById($id)
    {
        if ($this->checkExistsPeriodicServiceTimeById($id))
            return PeriodiceServiceTime::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPeriodicServiceTime()
    {
        return (PeriodiceServiceTime::withTrashed()->get()->count()>0) ? PeriodiceServiceTime::withTrashed()->get() : "notFound";
    }

    public function updatePeriodicServiceTime($id, $start_contract_time, $start_time, $periodic_time,
                                           $how_long, $periodic_service_id)
    {
        if ($this->checkExistsPeriodicServiceTimeById($id))
        {
            $periodicServiceTime = $this->selectPeriodicServiceTimeById($id);
            if ($start_contract_time != null) $periodicServiceTime->start_contract_time=$start_contract_time;
            if ($start_time != null) $periodicServiceTime->start_time=$start_time;
            if ($periodic_time != null) $periodicServiceTime->periodic_time=$periodic_time;
            if ($how_long != null) $periodicServiceTime->how_long=$how_long;
            if ($periodic_service_id != null) $periodicServiceTime->periodic_service_id=$periodic_service_id;
            return ($periodicServiceTime->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function deletePeriodicServiceTime($id)
    {
        if ($this->checkExistsPeriodicServiceTimeById($id))
            return PeriodiceServiceTime::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPeriodicServiceTimeById($id)
    {
//        return (bool)PeriodiceServiceTime::where("id",$id)->exists();
        return DB::table("periodic_service_times")->where("id", "=" , $id)->exists();
    }



}
