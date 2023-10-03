<?php

namespace App\Repository\Organization\Organization;

use App\Models\Organization\Organization\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrganizationRepo
{
    //////////////////////////////// Page
    public function showOrganizationPageInfo($holding_id)
    {
        $pageInfo = [
            "count"=>0,
            "organizations"=>null,
        ];

        if (Organization::where("holding_id", $holding_id)->exists())
        {
            $organizations = Organization::with(["holding", "salaryitemofyears", "depts"])->where("holding_id", $holding_id)->get();
            $pageInfo["count"] = DB::table("organizations")->count();

            foreach ($organizations as $organization)
            {
                $pageInfo["organizations"][] = [
                    "organization" => $organization
                ];
            }
        }


        return $pageInfo;
    }

    public function showAllOrganizationPageInfo()
    {
        $pageInfo = [
            "count"=>0,
            "organizations"=>null,
        ];

            $organizations = Organization::with(["holding", "salaryitemofyears", "depts"])->get();
            $pageInfo["count"] = DB::table("organizations")->count();

            foreach ($organizations as $organization)
            {
                $pageInfo["organizations"][] = [
                    "organization" => $organization
                ];
            }



        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertOrganization($title, $desc, $holding_id, $register_number,
                                       $economic_number, $address, $postal_code,
                                       $tellphone, $fax, $establishment_date)
    {
        $organization = new Organization();
        $organization->title = $title;
        $organization->description = $desc;
        $organization->holding_id = $holding_id;
        $organization->register_number = $register_number;
        $organization->economic_number = $economic_number;
        $organization->address = $address;
        $organization->postal_code = $postal_code;
        $organization->tellphone = $tellphone;
        $organization->fax = $fax;
        $organization->establishment_date = $establishment_date;
        return ($organization->save()) ? ["status" => "success", "result" => $organization] : ["status" => "failed"];
    }

    public function selectOrganizationById($id)
    {
        if ($this->checkExistsOrganizationById($id))
            return Organization::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllOrganizations()
    {
        return (Organization::withTrashed()->get()->count() > 0) ? Organization::withTrashed()->get() : "notFound";
    }

    public function updateOrganization($id, $title, $desc, $holding_id, $register_number,
                                            $economic_number, $address, $postal_code,
                                            $tellphone, $fax, $establishment_date)
    {
        if ($this->checkExistsOrganizationById($id)) {
            $organization = $this->selectOrganizationById($id);
            if ($title != null) $organization->title = $title;
            if ($desc != null) $organization->description = $desc;
            if ($holding_id != null) $organization->holding_id = $holding_id;
            if ($register_number != null) $organization->register_number = $register_number;
            if ($economic_number != null) $organization->economic_number = $economic_number;
            if ($address != null) $organization->address = $address;
            if ($postal_code != null) $organization->postal_code = $postal_code;
            if ($tellphone != null) $organization->tellphone = $tellphone;
            if ($fax != null) $organization->fax = $fax;
            if ($establishment_date != null) $organization->establishment_date = $establishment_date;
            return ($organization->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteOrganization($id)
    {
        if ($this->checkExistsOrganizationById($id))
            return Organization::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsOrganizationById($id)
    {
        return DB::table("organizations")->where("id", "=", $id)->exists();
    }

    public function checkExistsOrganizationByTitle($organization_id, $title = null)
    {
        if ($title == null)
            return true;

        $organizations = DB::table("organizations");
        if ($organization_id != null) $organizations->where("id", "<>", $organization_id);
        if ($title != null) $organizations->where("title", $title);
        return $organizations->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
