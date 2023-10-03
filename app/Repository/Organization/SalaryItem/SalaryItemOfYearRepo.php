<?php

namespace App\Repository\Organization\SalaryItem;

use App\Models\Organization\SalaryItem\SalaryItemOfYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalaryItemOfYearRepo
{
    //////////////////////////////// Page
    public function showSalaryItemOfYearPageInfo($org_id)
    {
        $pageInfo = [
            "count"=>0,
            "salaryItemOfYears"=>null,
        ];

        if (SalaryItemOfYear::where("org_id", $org_id)->exists())
        {
            $salaryItemOfYears = SalaryItemOfYear::with(["organization", "position_pay_salaries", "fiscal_years"])->where("org_id", $org_id)->get();
            $pageInfo["count"] = DB::table("mavarede_hoghooghe_sals")->count();

            foreach ($salaryItemOfYears as $SalaryItemOfYear)
            {
                $pageInfo["salaryItemOfYears"][] = [
                    "salaryItemOfYear" => $SalaryItemOfYear
                ];
            }
        }


        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertSalaryItemOfYear($title, $pardakhti, $org_id)
    {
        $SalaryItemOfYear = new SalaryItemOfYear();
        $SalaryItemOfYear->title = $title;
        $SalaryItemOfYear->pardakhti = $pardakhti;
        $SalaryItemOfYear->org_id = $org_id;
        return ($SalaryItemOfYear->save()) ? ["status" => "success", "result" => $SalaryItemOfYear] : ["status" => "failed"];
    }

    public function selectSalaryItemOfYearById($id)
    {
        if ($this->checkExistsSalaryItemOfYearById($id))
            return SalaryItemOfYear::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllSalaryItemOfYears()
    {
        return (SalaryItemOfYear::withTrashed()->get()->count() > 0) ? SalaryItemOfYear::withTrashed()->get() : "notFound";
    }

    public function updateSalaryItemOfYear($id, $title, $pardakhti, $org_id)
    {
        if ($this->checkExistsSalaryItemOfYearById($id)) {
            $SalaryItemOfYear = $this->selectSalaryItemOfYearById($id);
            if ($title != null) $SalaryItemOfYear->title = $title;
            if ($pardakhti != null) $SalaryItemOfYear->pardakhti = $pardakhti;
            if ($org_id != null) $SalaryItemOfYear->org_id = $org_id;
            return ($SalaryItemOfYear->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteSalaryItemOfYear($id)
    {
        if ($this->checkExistsSalaryItemOfYearById($id))
            return SalaryItemOfYear::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsSalaryItemOfYearById($id)
    {
        return DB::table("mavarede_hoghooghe_sals")->where("id", "=", $id)->exists();
    }

    public function checkExistsSalaryItemOfYearByTitle($salaryItemOfYear_id, $title = null)
    {
        if ($title == null)
            return true;

        $salaryItemOfYear = DB::table("mavarede_hoghooghe_sals");
        if ($salaryItemOfYear_id != null) $salaryItemOfYear->where("id", "<>", $salaryItemOfYear_id);
        if ($title != null) $salaryItemOfYear->where("title", $title);
        return $salaryItemOfYear->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
