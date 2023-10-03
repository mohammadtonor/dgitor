<?php

namespace App\Repository\PeriodicService\Archive;

use App\Models\PeriodicService\Archive\PeriodicServiceArchive;
use Illuminate\Support\Facades\DB;


class PeriodicServiceArchiveRepo
{


    //////////////////////////////// CRUD

    public function insertPeriodicServiceArchive($service_time, $done, $end, $periodic_service_id)
    {
        $periodicServiceArchive = new PeriodicServiceArchive();
        $periodicServiceArchive->service_time=$service_time;
        $periodicServiceArchive->done=$done;
        $periodicServiceArchive->end=$end;
        $periodicServiceArchive->periodic_service_id=$periodic_service_id;
        return ($periodicServiceArchive->save())? ["status"=>"success","result"=>$periodicServiceArchive]:["status"=>"failed"];

    }

    public function selectPeriodicServiceArchiveById($id)
    {
        if ($this->checkExistsPeriodicServiceArchiveById($id))
            return PeriodicServiceArchive::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPeriodicServiceArchive()
    {
        return (PeriodicServiceArchive::withTrashed()->get()->count()>0) ? PeriodicServiceArchive::withTrashed()->get() : "notFound";
    }

    public function updatePeriodicServiceArchive($id, $service_time, $done, $end, $periodic_service_id)
    {
        if ($this->checkExistsPeriodicServiceArchiveById($id))
        {
            $periodicServiceArchive = $this->selectPeriodicServiceArchiveById($id);
            if ($service_time != null) $periodicServiceArchive->service_time=$service_time;
            if ($done != null) $periodicServiceArchive->done=$done;
            if ($end != null) $periodicServiceArchive->end=$end;
            if ($periodic_service_id != null) $periodicServiceArchive->periodic_service_id=$periodic_service_id;

            return ($periodicServiceArchive->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function deletePeriodicServiceDesc($id)
    {
        if ($this->checkExistsPeriodicServiceArchiveById($id))
            return PeriodicServiceArchive::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPeriodicServiceArchiveById($id)
    {
        return DB::table("periodic_service_archives")->where("id", "=" , $id)->exists();
    }



}
