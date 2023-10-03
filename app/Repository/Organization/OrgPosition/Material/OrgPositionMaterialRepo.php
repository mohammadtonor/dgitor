<?php

namespace App\Repository\Organization\OrgPosition\Material;

use App\Models\Organization\OrgPosition\Material\OrgPositionMaterial;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrgPositionMaterialRepo
{
    //////////////////////////////// Page
    public function showOrgPositionMaterialPageInfo($org_position_id)
    {
        $pageInfo = [
            "count"=>0,
            "orgPositionMaterials"=>null,
        ];

        if (OrgPositionMaterial::where("org_position_id", $org_position_id)->exists())
        {
            $orgPositionMaterials = OrgPositionMaterial::with(["org_position"])->where("org_position_id", $org_position_id)->get();
            $pageInfo["count"] = DB::table("org_positions")->count();

            foreach ($orgPositionMaterials as $orgPositionMaterial)
            {
                $pageInfo["orgPositionMaterials"][] = [
                    "orgPositionMaterial" => $orgPositionMaterial
                ];
            }
        }


        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrgPositionMaterial($title, $desc, $material_type, $org_position_id)
    {
        $orgPositionMaterial = new OrgPositionMaterial();
        $orgPositionMaterial->title = $title;
        $orgPositionMaterial->description = $desc;
        $orgPositionMaterial->material_type = $material_type;
        $orgPositionMaterial->org_position_id = $org_position_id;
        return ($orgPositionMaterial->save()) ? ["status" => "success", "result" => $orgPositionMaterial] : ["status" => "failed"];
    }

    public function selectOrgPositionMaterialById($id)
    {
        if ($this->checkExistsOrgPositionMaterialById($id))
            return OrgPositionMaterial::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllOrgPositionMaterials()
    {
        return (OrgPositionMaterial::withTrashed()->get()->count() > 0) ? OrgPositionMaterial::withTrashed()->get() : "notFound";
    }

    public function updateOrgPositionMaterial($id, $title, $desc, $material_type, $org_position_id)
    {
        if ($this->checkExistsOrgPositionMaterialById($id)) {
            $orgPositionMaterial = $this->selectOrgPositionMaterialById($id);
            if ($title != null) $orgPositionMaterial->title = $title;
            if ($desc != null) $orgPositionMaterial->description = $desc;
            if ($material_type != null) $orgPositionMaterial->material_type = $material_type;
            if ($org_position_id != null) $orgPositionMaterial->org_position_id = $org_position_id;
            return ($orgPositionMaterial->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrgPositionMaterial($id)
    {
        if ($this->checkExistsOrgPositionMaterialById($id))
            return OrgPositionMaterial::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrgPositionMaterialById($id)
    {
        return DB::table("org_position_materials")->where("id", "=", $id)->exists();
    }

    public function checkExistsOrgPositionMaterialByTitle($orgPositionMaterial_id, $title = null)
    {
        if ($title == null)
            return true;

        $orgPositionMaterial = DB::table("org_position_materials");
        if ($orgPositionMaterial_id != null) $orgPositionMaterial->where("id", "<>", $orgPositionMaterial_id);
        if ($title != null) $orgPositionMaterial->where("title", $title);
        return $orgPositionMaterial->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
