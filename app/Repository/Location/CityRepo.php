<?php

namespace App\Repository\Location;

use App\Models\Location\City;
use Illuminate\Support\Facades\DB;

class CityRepo
{
    // ---------------------------------------- Page ---------------------------------------- //

    public function showCityPageInfo($ostan_id)
    {
        $ostan=DB::table("ostans")->where("id",$ostan_id)->first();
        $country = DB::table("countries")->where("id",$ostan->country_id)->first()->name;
        $pageInfo = [
            "count" => 0,
            "country" => null,
            "ostan" => null,
            "cities" => []
        ];

        if (DB::table("cities")->where("ostan_id" , $ostan_id)->exists())
        {
            $pageInfo["count"]=DB::table("cities")->where("ostan_id" , $ostan_id)->count();
            $allCities=City::withTrashed()->with(["ostan"])->where("ostan_id" , $ostan_id)->get();

            foreach ($allCities as $city)
            {
                $pageInfo["cities"][]=[
                    "city"=>$city,
                    "country"=> $country,
                    "ostan"=>$ostan->name,
                    "user_count"=>DB::table("users")->where("city_id",$city->id)->count()
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertCity($name, $country_id, $ostan_id)
    {
        if (!$this->checkExistsCityByTitle( $country_id, $ostan_id,null, $name))
        {
            $city = new City();
            $city->name = $name;
            $city->country_id = $country_id;
            $city->ostan_id = $ostan_id;
            return ($city->save()) ?
                ["status" => "success", "result" => $city] : ["status" => "failed"];
        }
        return ["status" => "duplicate"];

    }

    public function selectCityById($id)
    {
        if ($this->checkExistsCityById($id))
            return City::withTrashed()->with("country", "ostan")->where("id", $id)->first();
        return "notFound";
    }

    public function getAllCity($ostan_id)
    {
        return $this->showCityPageInfo($ostan_id);
    }

    public function deleteCity($id)
    {
        if ($this->checkExistsCityById($id))
        {
            if (DB::table("cities")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return City::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreCity($id)
    {
        if ($this->checkExistsCityById($id))
        {
            if (DB::table("cities")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return City::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }
    public function updateCity($id, $name, $country_id, $ostan_id)
    {
        if ($this->checkExistsCityById($id))
        {
            if (!$this->checkExistsCityByTitle( $country_id,$ostan_id,$id,$name))
            {
                $city = $this->selectCityById($id);
                if ($name != null) $city->name = $name;
                if ($country_id != null) $city->country_id = $country_id;
                if ($ostan_id != null) $city->ostan_id = $ostan_id;
                return ($city->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }




    // ---------------------------------------- Operations ---------------------------------------- //

    public function checkExistsCityById($id)
    {
        return DB::table("cities")->where("id", "=", $id)->exists();
    }

    public function checkExistsCityByTitle($country_id,$ostan_id,$city_id,$name)
    {
        if ($ostan_id == null || $country_id == null) return true;
        if ($name==null) return true;

        $cities = DB::table("cities")->where(["country_id"=>$country_id,"ostan_id"=>$ostan_id]);
        if ($city_id != null) $cities->where("id", "<>", $city_id);
        $cities->where("name",$name);
        return $cities->exists();
    }

    // ---------------------------------------- Relations ---------------------------------------- //


    public function getCountryOfCity($city_id)
    {
        if ($this->checkExistsCityById($city_id))
        {
            return ($this->selectCityById($city_id)->country()->count() > 0) ?
                $this->selectCityById($city_id)->country : "notFound";
        }
        return "city-notFound";
    }

    public function getOstanOfCity($city_id)
    {
        if ($this->checkExistsCityById($city_id))
        {
            return ($this->selectCityById($city_id)->ostan()->count() > 0) ?
                $this->selectCityById($city_id)->ostan : "notFound";
        }
        return "city-notFound";
    }

    public function getAllUserOfCity($city_id)
    {
        if ($this->checkExistsCityById($city_id))
        {
            return ($this->selectCityById($city_id)->users()->count() > 0) ?
                $this->selectCityById($city_id)->users : "notFound";
        }
        return "city-notFound";
    }
}
