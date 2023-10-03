<?php

namespace App\Repository\User\Address;

use App\Models\User\Address\UserAddress;
use Illuminate\Support\Facades\DB;

class UserAddressRepo
{
    //////////////////////////////// Page
    public function showUserAddressPageInfo($user_id)
    {
        $pageInfo = [
            "user" => DB::table("users")->where("id",$user_id)->first(),
            "count" => 0,
            "addrs" => []
        ];
        if (DB::table("user_addresses")->where("user_id",$user_id)->exists())
        {
            $pageInfo["count"] = DB::table("user_addresses")->where("user_id",$user_id)->count();
            $addresses = UserAddress::withTrashed()->with("city")->where("user_id",$user_id)->get();
            foreach ($addresses as $address)
            {
                $pageInfo["address"][] = [
                    "addr" => $address,
                    "ostan" => DB::table("ostans")->where("id", $address->city->ostan_id)->first()
                ];
            }
        }
        return $pageInfo;
    }


    //////////////////////////////// CRUD

    public function insertUserAddress($title, $postal_code, $address, $city_id, $user_id)
    {
        $userAddress = new UserAddress();
        $userAddress->title=$title;
        $userAddress->postal_code=$postal_code;
        $userAddress->address=$address;
        $userAddress->city_id = $city_id;
        $userAddress->user_id=$user_id;
        return ($userAddress->save())?
            ["status"=>"success","result"=>$userAddress]:
            ["status"=>"failed"];

    }

    public function selectUserAddressById($id)
    {
        if ($this->checkExistsUserAddressById($id))
        {
            $address = UserAddress::withTrashed()->with("city")->where("id",$id)->first();
            return [
                "address" => $address,
                "ostan" => DB::table("ostans")->where("id", $address->city->ostan_id)->first()
            ];
        }
        return "notFound";
    }

    public function selectAllUserAddress($user_id)
    {
        return $this->showUserAddressPageInfo($user_id);
    }


    public function deleteUserAddress($id)
    {
        if ($this->checkExistsUserAddressById($id))
        {
            if (DB::table("user_addresses")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return (UserAddress::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }


    public function restoreUserAddress($id)
    {
        if ($this->checkExistsUserAddressById($id))
        {
            if (DB::table("user_addresses")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return (UserAddress::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }



    public function updateUserAddress($id, $title, $postal_code, $address, $city_id, $user_id)
    {
        if ($this->checkExistsUserAddressById($id))
        {
            $userAddress = $this->selectUserAddressById($id)["address"];
            if ($title != null) $userAddress->title=$title;
            if ($postal_code != null) $userAddress->postal_code=$postal_code;
            if ($address != null) $userAddress->address=$address;
            if ($city_id != null) $userAddress->city_id=$city_id;
            if ($user_id != null) $userAddress->user_id=$user_id;
            return ($userAddress->save()) ? "success" : "failed";
        }
        return "notFound";
    }



    //////////////////////////////// Operation

    public function checkExistsUserAddressById($id)
    {
        return DB::table("user_addresses")->where("id", $id)->exists();
    }


    //////////////////////////////// Relation


}
