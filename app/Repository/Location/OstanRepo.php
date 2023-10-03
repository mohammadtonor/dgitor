<?php

namespace App\Repository\Location;

use App\Models\Location\Ostan;
use App\Repository\Contract\ACL\Ostan\OstanService;
use Illuminate\Support\Facades\DB;

class OstanRepo
{
    // ---------------------------------------- Page ---------------------------------------- //

    public function showOstanPageInfo($country_id)
    {
        $pageInfo = [
            "count" => 0,
            "country" => DB::table("countries")->where("id",$country_id)->first(),
            "ostans" => []
        ];

        if (DB::table("ostans")->where("country_id", $country_id)->exists())
        {
            $pageInfo["count"] = DB::table("ostans")->where("country_id", $country_id)->count();
            $ostans = Ostan::withTrashed()->with(["country", "cities"])->where("country_id", $country_id)->get();
            foreach ($ostans as $ostan)
            {
                $pageInfo["ostans"][] = [
                    "ostan" => $ostan,
                    "city_count" => DB::table("cities")->where("ostan_id",$ostan->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertOstan($name, $country_id)
    {
        if (!$this->checkExistsOstanByTitle($country_id,null,  $name))
        {
            $ostan = new Ostan();
            $ostan->name = $name;
            $ostan->country_id = $country_id;
            return ($ostan->save()) ?
                ["status" => "success", "result" => $ostan] : ["status" => "failed"];
        }
        return ["status" => "duplicate"];
    }

    public function selectOstanById($id)
    {
        if ($this->checkExistsOstanById($id))
            return Ostan::withTrashed()->with("country")->where("id", $id)->first();
        return "notFound";
    }

    public function getAllOstanOfCountry($country_id)
    {
        return $this->showOstanPageInfo($country_id);
    }



    public function deleteOstan($id)
    {
        if ($this->checkExistsOstanById($id))
        {
            if (DB::table("ostans")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return (Ostan::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreOstan($id)
    {
        if ($this->checkExistsOstanById($id))
        {
            if (DB::table("ostans")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return (Ostan::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateOstan($id, $name, $country_id)
    {
        if ($this->checkExistsOstanById($id))
        {
            if (!$this->checkExistsOstanByTitle($country_id,$id,  $name))
            {
                $ostan = $this->selectOstanById($id);
                if ($name != null) $ostan->name = $name;
                if ($country_id != null) $ostan->country_id = $country_id;
                return ($ostan->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }
    // ---------------------------------------- Operations ---------------------------------------- //

    public function checkExistsOstanById($id)
    {
        return DB::table("ostans")->where("id", $id)->exists();
    }


    public function checkExistsOstanByTitle($country_id,$ostan_id,  $name)
    {
        if ($country_id == null) return true;
        if ($name == null) return true;

        $ostans = DB::table("ostans")->where("country_id",$country_id);
        if ($ostan_id != null) $ostans = $ostans->where("id", "<>", $ostan_id);
        $ostans->where("name",$name);
        return $ostans->exists();
    }

    // ---------------------------------------- Relations ---------------------------------------- //

    public function getCitiesOfOstan($id)
    {
        if ($this->checkExistsOstanById($id)) {
            return ($this->selectOstanById($id)->cities()->count() > 0) ?
                $this->selectOstanById($id)->cities : "notFound";
        }
        return "ostan-notFound";
    }

    public function getCountryOfOstan($id)
    {
        if ($this->checkExistsOstanById($id)) {
            return ($this->selectOstanById($id)->country()->count() > 0) ?
                $this->selectOstanById($id)->country : "notFound";
        }
        return "ostan-notFound";
    }


}
