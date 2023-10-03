<?php

namespace App\Repository\Location;

use App\Models\Location\Country;
use App\Repository\Contract\ACL\Country\CountryService;
use Illuminate\Support\Facades\DB;

class CountryRepo implements CountryService
{
    // ---------------------------------------- Page ---------------------------------------- //

    public function showCountryPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "countries" => null
        ];
        if (DB::table("countries")->count() > 0) {
            $pageInfo["count"] = DB::table("countries")->count();
            $countries = Country::withTrashed()->get();
            foreach ($countries as $country){
                $pageInfo["countries"][] = [
                    "country" => $country,
                    "ostan_count" => $country->ostans()->count(),
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //

    public function insertCountry($name)
    {
        if (!$this->checkExistsCountryByTitle(null, $name)) {
            $country = new Country();
            $country->name = $name;
            return ($country->save()) ?
                ["status" => "success", "result" => $country] : ["status" => "failed"];
        }
        return ["status" => "duplicate"];
    }

    public function selectCountryById($id)
    {
        if ($this->checkExistsCountryById($id)) {
            return Country::withTrashed()->where("id", $id)->first();
        }
        return "notFound";
    }

    public function selectAllCountry()
    {
        return $this->showCountryPageInfo();
    }


    public function deleteCountry($id)
    {
        if ($this->checkExistsCountryById($id)) {
            if (DB::table("countries")->where("id", $id)->whereNull("deleted_at")->exists()) {
                return (Country::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreCountry($id)
    {
        if ($this->checkExistsCountryById($id)) {
            if (DB::table("countries")->where("id", $id)->whereNotNull("deleted_at")->exists()) {
                return Country::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }


    public function updateCountry($id, $name)
    {
        if ($this->checkExistsCountryById($id)) {
            if (!$this->checkExistsCountryByTitle($id, $name)) {
                $country = $this->selectCountryById($id);
                if ($name!=null)$country->name = $name;
                return ($country->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }



    // ---------------------------------------- Operations ---------------------------------------- //

    public function checkExistsCountryById($id)
    {
        return DB::table("countries")->where("id", $id)->exists();
    }

    public function checkExistsCountryByTitle($country_id, $name = null)
    {
        if ($name == null) return true;

        $countries = DB::table("countries");
        if ($country_id != null) $countries = $countries->where("id", "<>", $country_id);
        $countries->where("name", $name);
        return $countries->exists();
    }

    // ---------------------------------------- Relations ---------------------------------------- //



    public function getAllOstanOfCountry($id)
    {
        if ($this->checkExistsCountryById($id)) {
            return ($this->selectCountryById($id)->ostans()->count() > 0) ?
                $this->selectCountryById($id)->ostans : "ostan-notFound";
        }
        return "notFound";
    }

    public function getAllCityOfCountry($id)
    {
        if ($this->checkExistsCountryById($id)) {
            return ($this->selectCountryById($id)->cities()->count() > 0) ?
                $this->selectCountryById($id)->cities : "city-notFound";
        }
        return "notFound";
    }
}
