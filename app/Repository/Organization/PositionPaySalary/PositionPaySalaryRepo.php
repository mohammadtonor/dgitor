<?php

namespace App\Repository\Organization\PositionPaySalary;

use App\Models\Organization\PositionPaysalary\PositionPaysalary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PositionPaySalaryRepo
{
    //////////////////////////////// Page
    public function showPositionPaysalaryPageInfo()
    {
        $pageInfo = [
            "count"=>0,
            "positionPaySalaries"=>null,
        ];

        $positionPaySalaries = PositionPaysalary::with(["org_position", "salaryitemofyear", "payslip"])->get();
        $pageInfo["count"] = DB::table("position_pay_salary")->count();

        foreach ($positionPaySalaries as $positionPaySalary)
        {
            $pageInfo["positionPaySalaries"][] = [
                "positionPaySalary" => $positionPaySalary
            ];
        }

        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPositionPaysalary($position_id, $pay_id, $salary_id)
    {
        $positionPaysalary = new PositionPaysalary();
        $positionPaysalary->position_id = $position_id;
        $positionPaysalary->pay_id = $pay_id;
        $positionPaysalary->salary_id = $salary_id;
        return ($positionPaysalary->save()) ? ["status" => "success", "result" => $positionPaysalary] : ["status" => "failed"];
    }

    public function selectPositionPaysalaryById($id)
    {
        if ($this->checkExistsPositionPaysalaryById($id))
            return PositionPaysalary::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllPositionPaysalarys()
    {
        return (PositionPaysalary::withTrashed()->get()->count() > 0) ? PositionPaysalary::withTrashed()->get() : "notFound";
    }

    public function updatePositionPaysalary($id, $position_id, $pay_id, $salary_id)
    {
        if ($this->checkExistsPositionPaysalaryById($id)) {
            $PositionPaysalary = $this->selectPositionPaysalaryById($id);
            if ($position_id != null) $PositionPaysalary->position_id = $position_id;
            if ($pay_id != null) $PositionPaysalary->pay_id = $pay_id;
            if ($salary_id != null) $PositionPaysalary->salary_id = $salary_id;
            return ($PositionPaysalary->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deletePositionPaysalary($id)
    {
        if ($this->checkExistsPositionPaysalaryById($id))
            return PositionPaysalary::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPositionPaysalaryById($id)
    {
        return DB::table("position_pay_salary")->where("id", "=", $id)->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
