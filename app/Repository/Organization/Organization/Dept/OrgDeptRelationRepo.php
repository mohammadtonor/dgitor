<?php

namespace App\Repository\Organization\Organization\Dept;

use App\Models\Organization\Organization\Dept\OrgDeptRelation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrgDeptRelationRepo
{

    //////////////////////////////// CRUD

    public function insertOrgDeptRelation($type_relation, $org_dept1_id, $org_dept2_id)
    {
        $OrgDeptRelation = new OrgDeptRelation();
        $OrgDeptRelation->type_relation = $type_relation;
        $OrgDeptRelation->org_dept1_id = $org_dept1_id;
        $OrgDeptRelation->org_dept2_id = $org_dept2_id;

        return ($OrgDeptRelation->save()) ? ["status" => "success", "result" => $OrgDeptRelation] : ["status" => "failed"];
    }

    public function selectOrgDeptRelationById($id)
    {
        if ($this->checkExistsOrgDeptRelationById($id))
            return OrgDeptRelation::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllOrgDeptRelations()
    {
        return (OrgDeptRelation::withTrashed()->get()->count() > 0) ? OrgDeptRelation::withTrashed()->get() : "notFound";
    }

    public function updateOrgDeptRelation($id, $type_relation, $org_dept1_id, $org_dept2_id)
    {
        if ($this->checkExistsOrgDeptRelationById($id)) {
            $OrgDeptRelation = $this->selectOrgDeptRelationById($id);
            if ($type_relation != null) $OrgDeptRelation->type_relation = $type_relation;
            if ($org_dept1_id != null) $OrgDeptRelation->org_dept1_id = $org_dept1_id;
            if ($org_dept2_id != null) $OrgDeptRelation->org_dept2_id = $org_dept2_id;

            return ($OrgDeptRelation->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrgDeptRelation($id)
    {
        if ($this->checkExistsOrgDeptRelationById($id))
            return OrgDeptRelation::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrgDeptRelationById($id)
    {
        return DB::table("org_depts")->where("id", "=", $id)->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
