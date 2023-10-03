<?php

namespace App\Repository\Organization\OrgPosition;

use App\Models\Organization\OrgPosition\OrgPosition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrgPositionRepo
{
    //////////////////////////////// Page
    public function showOrgPositionPageInfo()
    {
        $pageInfo = [
            "count"=>0,
            "orgPositions"=>null,
        ];

        $orgPositions = OrgPosition::with(["position_pay_salaries", "org_dept", "position_user_archives", "users", "permissions", "materials", "childrens", "parent"])->get();
        $pageInfo["count"] = DB::table("org_positions")->count();

        foreach ($orgPositions as $orgPosition)
        {
            $pageInfo["orgPositions"][] = [
                "orgPosition" => $orgPosition
            ];
        }

        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrgPosition($title, $desc, $org_dept_id, $org_position_id)
    {
        $orgPosition = new OrgPosition();
        $orgPosition->title = $title;
        $orgPosition->description = $desc;
        $orgPosition->org_dept_id = $org_dept_id;
        $orgPosition->org_position_id = $org_position_id;
        return ($orgPosition->save()) ? ["status" => "success", "result" => $orgPosition] : ["status" => "failed"];
    }

    public function selectOrgPositionById($id)
    {
        if ($this->checkExistsOrgPositionById($id))
            return OrgPosition::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllOrgPositions()
    {
        return (OrgPosition::withTrashed()->get()->count() > 0) ? OrgPosition::withTrashed()->get() : "notFound";
    }

    public function updateOrgPosition($id, $title, $desc, $org_dept_id, $org_position_id)
    {
        if ($this->checkExistsOrgPositionById($id)) {
            $orgPosition = $this->selectOrgPositionById($id);
            if ($title != null) $orgPosition->title = $title;
            if ($desc != null) $orgPosition->description = $desc;
            if ($org_dept_id != null) $orgPosition->org_dept_id = $org_dept_id;
            if ($org_position_id != null) $orgPosition->org_position_id = $org_position_id;
            return ($orgPosition->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrgPosition($id)
    {
        if ($this->checkExistsOrgPositionById($id))
            return OrgPosition::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrgPositionById($id)
    {
        return DB::table("org_positions")->where("id", "=", $id)->exists();
    }

    public function checkExistsOrgPositionByTitle($orgPosition_id, $title = null)
    {
        if ($title == null)
            return true;

        $orgPositions = DB::table("org_positions");
        if ($orgPosition_id != null) $orgPositions->where("id", "<>", $orgPosition_id);
        if ($title != null) $orgPositions->where("title", $title);
        return $orgPositions->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
