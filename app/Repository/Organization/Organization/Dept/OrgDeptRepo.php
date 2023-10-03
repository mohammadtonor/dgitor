<?php

namespace App\Repository\Organization\Organization\Dept;

use App\Models\Organization\Organization\Dept\OrgDept;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrgDeptRepo
{
    //////////////////////////////// Page
    public function showOrgDeptPageInfo($org_id)
    {
        $pageInfo = [
            "count"=>0,
            "orgDepts"=>null,
        ];

        if (OrgDept::where("org_id", $org_id)->exists())
        {
            $orgDepts = OrgDept::with(["organization", "org_positions", "relations1", "relations2"])->where("org_id", $org_id)->get();
            $pageInfo["count"] = DB::table("org_depts")->count();

            foreach ($orgDepts as $orgDept)
            {
                $pageInfo["orgDepts"][] = [
                    "OrgDept" => $orgDept
                ];
            }
        }


        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrgDept($title, $desc, $org_id, $register_number,
                                       $economic_number, $address, $postal_code,
                                       $tellphone, $fax, $establishment_date)
    {
        $orgDept = new OrgDept();
        $orgDept->title = $title;
        $orgDept->description = $desc;
        $orgDept->org_id = $org_id;
        $orgDept->register_number = $register_number;
        $orgDept->economic_number = $economic_number;
        $orgDept->address = $address;
        $orgDept->postal_code = $postal_code;
        $orgDept->tellphone = $tellphone;
        $orgDept->fax = $fax;
        $orgDept->establishment_date = $establishment_date;
        return ($orgDept->save()) ? ["status" => "success", "result" => $orgDept] : ["status" => "failed"];
    }

    public function selectOrgDeptById($id)
    {
        if ($this->checkExistsOrgDeptById($id))
            return OrgDept::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllOrgDepts()
    {
        return (OrgDept::withTrashed()->get()->count() > 0) ? OrgDept::withTrashed()->get() : "notFound";
    }

    public function updateOrgDept($id, $title, $desc, $org_id, $register_number,
                                       $economic_number, $address, $postal_code,
                                       $tellphone, $fax, $establishment_date)
    {
        if ($this->checkExistsOrgDeptById($id)) {
            $OrgDept = $this->selectOrgDeptById($id);
            if ($title != null) $OrgDept->title = $title;
            if ($desc != null) $OrgDept->description = $desc;
            if ($org_id != null) $OrgDept->org_id = $org_id;
            if ($register_number != null) $OrgDept->register_number = $register_number;
            if ($economic_number != null) $OrgDept->economic_number = $economic_number;
            if ($address != null) $OrgDept->address = $address;
            if ($postal_code != null) $OrgDept->postal_code = $postal_code;
            if ($tellphone != null) $OrgDept->tellphone = $tellphone;
            if ($fax != null) $OrgDept->fax = $fax;
            if ($establishment_date != null) $OrgDept->establishment_date = $establishment_date;
            return ($OrgDept->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrgDept($id)
    {
        if ($this->checkExistsOrgDeptById($id))
            return OrgDept::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrgDeptById($id)
    {
        return DB::table("org_depts")->where("id", "=", $id)->exists();
    }

    public function checkExistsOrgDeptByTitle($orgDept_id, $title = null)
    {
        if ($title == null)
            return true;

        $OrgDepts = DB::table("org_depts");
        if ($orgDept_id != null) $OrgDepts->where("id", "<>", $orgDept_id);
        if ($title != null) $OrgDepts->where("title", $title);
        return $OrgDepts->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
