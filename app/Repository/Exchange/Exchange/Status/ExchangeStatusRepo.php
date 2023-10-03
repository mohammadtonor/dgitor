<?php

namespace App\Repository\Exchange\Exchange\Status;

use App\Models\Exchange\Exchange\Status\ExchangeStatus;
use Illuminate\Support\Facades\DB;

class ExchangeStatusRepo
{


    //////////////////////////////// CRUD

    public function insertExchangeStatus($title)
    {
        $exchangeStatus = new ExchangeStatus();
        $exchangeStatus->title=$title;
        return ($exchangeStatus->save())? ["status"=>"success","result"=>$exchangeStatus]:["status"=>"failed"];
    }

    public function selectExchangeStatusById($id)
    {
        if ($this->checkExistsExchangeStatusById($id))
            return ExchangeStatus::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExchangeStatuses()
    {
        return (ExchangeStatus::withTrashed()->get()->count()>0) ? ExchangeStatus::withTrashed()->get() : "notFound";
    }

    public function updateExchangeStatus($id, $title)
    {
        if ($this->checkExistsExchangeStatusById($id))
        {
            $exchangeStatus = $this->selectExchangeStatusById($id);
            if ($title != null) $exchangeStatus->title=$title;


            return ($exchangeStatus->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteExchangeStatus($id)
    {
        if ($this->checkExistsExchangeStatusById($id))
            return ExchangeStatus::withTrashed()->where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsExchangeStatusById($id)
    {
        return DB::table("exchange_statuses")->where("id", "=" , $id)->exists();
    }

    public function checkExistExchangeStatusByTitle($status_id,$title=null)
    {
        if ($title==null)
            return true;

        $statuses = DB::table("exchange_statuses");
        if ($status_id!=null) $statuses->where("id","<>",$status_id);
        if ($title!=null) $statuses->where("title",$title);
        return $statuses->exists();
    }
    //////////////////////////////// Relation

}
