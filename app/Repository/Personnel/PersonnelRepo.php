<?php

namespace App\Repository\Personnel;


use App\Models\User;
use App\Models\User\Address\UserAddress;
use App\Models\User\Phone\UserPhone;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isFalse;

class PersonnelRepo
{
    //////////////////////////////// Page

    public function insertPersonelPageInfo()
    {
        $pageInfo=[
            "ostans"=>DB::table("ostans")->where("country_id",1)->whereNull("deleted_at")->get(),
            "roles"=>DB::table("roles")->whereNull("deleted_at")->get()
        ];

        return $pageInfo;
    }


    public function showPersonnelPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "active_count" => 0,
            "personels" => null,
        ];

        if (DB::table("users")->where("is_personel","1")->exists())
        {
            $pageInfo["count"]=DB::table("users")->where("is_personel","1")->count();
            $pageInfo["personels"]=User::withTrashed()->with(["city","roles","ostan"])->where("is_personel",'1')->get();
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPersonnel($name, $family, $gender, $ncode, $birthday,
                                    $mobile, $email, $role_ids, $ostan_id, $city_id,
                                    $mobile_verification_code,  $postal_code, $address)
    {
        if (!$this->checkExistPersonelByInfo(null,$ncode,$email,$mobile))
        {
            DB::beginTransaction();
            $personnel = new User();
            $personnel->name = $name;
            $personnel->family = $family;
            $personnel->gender = ($gender == "زن") ? "female" : "male";
            $personnel->ncode = $ncode;
            $personnel->birthday = $birthday;
            $personnel->mobile = $mobile;
            $personnel->email = $email;
            $personnel->country_id = 1;
            $personnel->ostan_id = $ostan_id;
            $personnel->city_id = $city_id;
            $personnel->mobile_verification_code = $mobile_verification_code;
            if ($personnel->save())
            {
                try
                {
                    //address
                    $addr=new UserAddress();
                    $addr->title="main";
                    $addr->postal_code=$postal_code;
                    $addr->address=$address;
                    $addr->city_id=$city_id;
                    $addr->user_id=$personnel->id;
                    $addr->save();

                    //phone
                    $phone=new UserPhone();
                    $phone->title="main";
                    $phone->phone=$mobile;
                    $phone->user_id=$personnel->id;
                    $phone->save();

                    //roles
                    $personnel->roles()->sync($role_ids);

                    DB::commit();
                    return  ["status"=>"success","result"=>$personnel];

                }
                catch (\Exception $e)
                {
                    DB::rollBack();
                    return ["status"=>"failed"];
                }
            }
            DB::rollBack();
            return ["status" => "personel-failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectPersonnelById($id)
    {
        if ($this->checkExistsPersonnelById($id))
            return User::withTrashed()->with(["city", "phones", "roles"])->where("id", $id)->first();
        return "notFound";
    }

    public function getAll()
    {
        return $this->showPersonnelPageInfo();
    }

    public function deletePersonnel($id)
    {
        if ($this->checkExistsPersonnelById($id))
        {
            if (DB::table("users")->where("id", $id)->whereNull("deleted_at")->exists()) {
                return (User::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePersonnel($user_id)
    {
        if ($this->checkExistsPersonnelById($user_id))
        {
            if (DB::table("users")->where("id", $user_id)->whereNotNull("deleted_at")->exists()){
                return (User::withTrashed()->where("id", $user_id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePersonnel($id, $name, $family, $gender, $ncode, $birthday,
                                    $mobile, $email,$ostan_id, $city_id)

    {
        if ($this->checkExistsPersonnelById($id))
        {
            if (!$this->checkExistPersonelByInfo($id,$ncode,$email,$mobile))
            {
                DB::beginTransaction();
                $personnel = $this->selectPersonnelById($id);
                if ($name != null) $personnel->name = $name;
                if ($family != null) $personnel->family = $family;
                if ($gender != null) $personnel->gender = ($gender == "زن") ? "female" : "male";;
                if ($ncode != null) $personnel->ncode = $ncode;
                if ($birthday != null) $personnel->birthday = $birthday;
                if ($mobile != null) $personnel->mobile = $mobile;
                if ($email != null) $personnel->email = $email;
                if ($ostan_id != null) $personnel->ostan_id = $ostan_id;
                if ($city_id != null) $personnel->city_id = $city_id;
                if ($personnel->save())
                {
                    DB::commit();
                    return "success";
                }
                DB::rollBack();
                return "failed";
            }
            DB::rollBack();
            return "duplicate";
        }
        return "notFound";
    }


    //////////////////////////////// Operation

    public function checkExistsPersonnelById($id)
    {
        return DB::table("users")->where("id", "=" , $id)->exists();
    }

    public function checkExistPersonelByInfo($id,$ncode=null,$email=null,$mobile=null)
    {
        if ($ncode==null && $email==null && $mobile==null) return true;

        $query=DB::table("users");
        if ($id!=null) $query->where("id","<>",$id);
        if ($ncode!=null) $query->where("ncode",$ncode);
        if ($email!=null) $query->where("email",$email);
        if ($mobile!=null) $query->where("mobile",$mobile);
        return $query->exists();
    }


    public function search($name=null, $family=null, $ncode=null,
                           $mobile=null, $ostan_id=null, $city_id=null)
    {
        $query = User::with(["city", "phones", "roles"])->where("is_personel", '1')->select("*");
        if ($name != null) $query->where("name", "like", "%".$name."%");
        if ($family != null) $query->where("family", "like", "%".$family."%");
        if ($ncode != null) $query->where("ncode", "like", "%".$ncode."%");
        if ($mobile != null) $query->where("mobile", "like", "%".$mobile."%");
        if ($ostan_id != null) $query->where("ostan_id", "=", $ostan_id);
        if ($city_id != null) $query->where("city_id", "=", $city_id);

        return $query->exists() ? $query->get() : "notFound";

    }



}
