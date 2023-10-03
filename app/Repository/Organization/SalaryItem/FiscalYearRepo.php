<?php

namespace App\Repository\Organization\SalaryItem;

use App\Models\Organization\SalaryItem\FiscalYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FiscalYearRepo
{
    //////////////////////////////// Page
    public function showFiscalYearPageInfo($mavared_hoghooghe_sals_id)
    {
        $pageInfo = [
            "count" => 0,
            "FiscalYears" => null,
        ];
        if (FiscalYear::where("mavared_hoghooghe_sals_id", $mavared_hoghooghe_sals_id)->exists())
        {
            $FiscalYears = FiscalYear::withTrashed()->where("mavared_hoghooghe_sals_id", $mavared_hoghooghe_sals_id)->get();
            $pageInfo["count"] = $FiscalYears->count();
            foreach ($FiscalYears as $FiscalYear) {

                $pageInfo["FiscalYears"][] = [
                    "id" => $FiscalYear->id,
                    "title" => $FiscalYear->title,
                    "desc" => $FiscalYear->descripton,
                    "organizations" => $FiscalYear->organizations
                ];
        }

        }

        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertFiscalYear($title, $start_date, $end_date,
                                     $darayi, $bedehi, $sarmaye, $sood,
                                     $zian, $gardeshe_vojoohe_naghd,
                                     $pardakhti, $mavared_hoghooghe_sals_id)
    {
        $fiscalYear = new FiscalYear();
        $fiscalYear->title = $title;
        $fiscalYear->start_date = $start_date;
        $fiscalYear->end_date = $end_date;
        $fiscalYear->darayi = $darayi;
        $fiscalYear->bedehi = $bedehi;
        $fiscalYear->sarmaye = $sarmaye;
        $fiscalYear->sood = $sood;
        $fiscalYear->zian = $zian;
        $fiscalYear->gardeshe_vojoohe_naghd = $gardeshe_vojoohe_naghd;
        $fiscalYear->pardakhti = $pardakhti;
        $fiscalYear->mavared_hoghooghe_sals_id = $mavared_hoghooghe_sals_id;

        return ($fiscalYear->save()) ? ["status" => "success", "result" => $fiscalYear] : ["status" => "failed"];
    }

    public function selectFiscalYearById($id)
    {
        if ($this->checkExistsFiscalYearById($id))
            return FiscalYear::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllFiscalYears()
    {
        return (FiscalYear::withTrashed()->get()->count() > 0) ? FiscalYear::withTrashed()->get() : "notFound";
    }

    public function updateFiscalYear($id, $title, $start_date, $end_date,
                                          $darayi, $bedehi, $sarmaye, $sood,
                                          $zian, $gardeshe_vojoohe_naghd,
                                          $pardakhti, $mavared_hoghooghe_sals_id)
    {
        if ($this->checkExistsFiscalYearById($id)) {
            $fiscalYear = $this->selectFiscalYearById($id);
            if ($title != null) $fiscalYear->title = $title;
            if ($start_date != null) $fiscalYear->start_date = $start_date;
            if ($end_date != null) $fiscalYear->end_date = $end_date;
            if ($darayi != null) $fiscalYear->darayi = $darayi;
            if ($bedehi != null) $fiscalYear->bedehi = $bedehi;
            if ($sarmaye != null) $fiscalYear->sarmaye = $sarmaye;
            if ($sood != null) $fiscalYear->sood = $sood;
            if ($zian != null) $fiscalYear->zian = $zian;
            if ($gardeshe_vojoohe_naghd != null) $fiscalYear->gardeshe_vojoohe_naghd = $gardeshe_vojoohe_naghd;
            if ($pardakhti != null) $fiscalYear->pardakhti = $pardakhti;
            if ($mavared_hoghooghe_sals_id != null) $fiscalYear->mavared_hoghooghe_sals_id = $mavared_hoghooghe_sals_id;
            return ($fiscalYear->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteFiscalYear($id)
    {
        if ($this->checkExistsFiscalYearById($id))
            return FiscalYear::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsFiscalYearById($id)
    {
        return DB::table("fiscal_years")->where("id", "=", $id)->exists();
    }

    public function checkExistsFiscalYearByTitle($fiscalYear_id, $title = null)
    {
        if ($title == null)
            return true;

        $fiscalYear = DB::table("fiscal_years");
        if ($fiscalYear_id != null) $fiscalYear->where("id", "<>", $fiscalYear_id);
        if ($title != null) $fiscalYear->where("title", $title);
        return $fiscalYear->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
