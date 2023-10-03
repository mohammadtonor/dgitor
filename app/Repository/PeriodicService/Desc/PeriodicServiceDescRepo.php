<?php

namespace App\Repository\PeriodicService\Desc;

use App\Models\PeriodicService\Desc\PeriodicServiceDesc;
use Illuminate\Support\Facades\DB;


class PeriodicServiceDescRepo
{


    //////////////////////////////// CRUD

    public function insertPeriodicServiceDesc($desc, $periodic_service_id)
    {
        $periodicServiceDesc = new PeriodicServiceDesc();
        $periodicServiceDesc->description=$desc;
        $periodicServiceDesc->periodic_service_id=$periodic_service_id;

        return ($periodicServiceDesc->save())? ["status"=>"success","result"=>$periodicServiceDesc]:["status"=>"failed"];

    }

    public function selectPeriodicServiceDescById($id)
    {
        if ($this->checkExistsPeriodicServiceDescById($id))
            return PeriodicServiceDesc::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPeriodicServiceDesc()
    {
        return (PeriodicServiceDesc::withTrashed()->get()->count()>0) ? PeriodicServiceDesc::withTrashed()->get() : "notFound";
    }

    public function updatePeriodicServiceDesc($id, $desc, $periodic_service_id)
    {
        if ($this->checkExistsPeriodicServiceDescById($id))
        {
            $periodicServiceDesc = $this->selectPeriodicServiceDescById($id);
            if ($desc != null) $periodicServiceDesc->desc=$desc;
            if ($periodic_service_id != null) $periodicServiceDesc->periodic_service_id=$periodic_service_id;

            return ($periodicServiceDesc->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function deletePeriodicServiceDesc($id)
    {
        if ($this->checkExistsPeriodicServiceDescById($id))
            return PeriodicServiceDesc::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPeriodicServiceDescById($id)
    {
        return DB::table("periodic_service_descs")->where("id", "=" , $id)->exists();
    }



}
