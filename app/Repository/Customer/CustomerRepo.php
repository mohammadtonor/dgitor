<?php

namespace App\Repository\Customer;


use App\Models\User;
use App\Models\User\Address\UserAddress;
use App\Models\User\Phone\UserPhone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

//use function PHPUnit\Framework\isFalse;


class CustomerRepo
{
    //////////////////////////////// Page

    public function insertCustomerShowPage()
    {
        $pageInfo = [
            "ostans" => null,
            "user_count" => 0,
            "city_count" => 0
        ];
        $customerRoleId = DB::table("roles")->where("name_en", "customer")->first()->id;

        $pageInfo["ostans"] = DB::table("ostans")->where("country_id",1)->whereNull("deleted_at")->get();
        $pageInfo["user_count"] = DB::table("users")->whereIn("id", DB::table("role_user")->where("role_id", $customerRoleId)->pluck("user_id")->toArray())->count();
        $pageInfo["city_count"] = DB::table("users")->distinct("city_id")->count();

        return $pageInfo;
    }


    public function showCustomerPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "customers" => [],
        ];

        if (User::whereHas("roles",function (Builder  $query){ $query->where("name_en","customer");})->exists())
        {
            $pageInfo["count"]=User::whereHas("roles",function (Builder  $query){ $query->where("name_en","customer");})->count();

            $allCustomer=User::withTrashed()->with(["city","ostan"])->whereHas("roles",function (Builder  $query){ $query->where("name_en","customer");})->get();

            foreach ($allCustomer as $customer)
            {
                $pageInfo["customers"][]=[
                    "customer"=>$customer,
//                    "city"=>DB::table("cities")->where("id",$customer->city_id)->get(),
                    "karshenases"=>DB::table("users")->whereIn("id",
                                        DB::table("customer_karshenas")->where("customer_user_id",$customer->id)->pluck("id")->toArray())->get(),
                    "exchange_count" => 0,
                    "karshenasi_count" => 0
                ];
            }
        }
        return  $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertCustomer($name, $family, $gender, $ncode, $birthday,
                                    $mobile, $email, $ostan_id, $city_id,
                                    $mobile_verification_code,  $postal_code, $address)
    {
        if (!$this->checkExistCustomerByInfo(null,$ncode,$email,$mobile))
        {
            DB::beginTransaction();
            $customer = new User();
            $customer->name = $name;
            $customer->family = $family;
            $customer->gender = ($gender == "زن") ? "female" : "male";
            $customer->ncode = $ncode;
            $customer->birthday = $birthday;
            $customer->mobile = $mobile;
            $customer->email = $email;
            $customer->country_id = 1;
            $customer->ostan_id = $ostan_id;
            $customer->city_id = $city_id;
            $customer->mobile_verification_code = $mobile_verification_code;
            if ($customer->save())
            {
                try {
                    //address
                    $addr=new UserAddress();
                    $addr->title="main";
                    $addr->postal_code=$postal_code;
                    $addr->address=$address;
                    $addr->city_id=$city_id;
                    $addr->user_id=$customer->id;
                    $addr->save();


                    $phone=new UserPhone();
                    $phone->title="main";
                    $phone->phone=$mobile;
                    $phone->user_id=$customer->id;
                    $phone->save();

                    // add customer role
                    $roleId = DB::table("roles")->where("name_en", "customer")->first("id")->id;
                    DB::table("role_user")->insert(["user_id" => $customer->id, "role_id" => $roleId]);

                    DB::commit();
                    return ["status"=>"success","result"=>$customer];

                }
                catch (\Exception $e)
                {
                    DB::rollBack();
                    return ["status"=>"failed"];
                }
            }
            DB::rollBack();
            return ["status" => "customer-failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectCustomerById($id)
    {
        if ($this->checkExistsCustomerById($id))
            return User::withTrashed()->with(["city","ostan"])->where("id", $id)->first();
        return "notFound";
    }

    public function getAll()
    {
        return $this->showCustomerPageInfo();
    }

    public function deleteCustomer($id)
    {
        if ($this->checkExistsCustomerById($id)) {
            if (DB::table("users")->where("id", $id)->whereNull("deleted_at")->exists()) {
                return (User::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreCustomer($user_id)
    {
        if ($this->checkExistsCustomerById($user_id)) {
            if (DB::table("users")->where("id", $user_id)->whereNotNull("deleted_at")->exists()){
                return (User::withTrashed()->where("id", $user_id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateCustomer($id, $name, $family, $gender, $ncode, $birthday,$mobile, $email,$ostan_id, $city_id)
    {
        if ($this->checkExistsCustomerById($id)) {
            if (!$this->checkExistCustomerByInfo($id,$ncode,$email,$mobile))
            {
                DB::beginTransaction();
                $Customer = $this->selectCustomerById($id);
                if ($name != null) $Customer->name = $name;
                if ($family != null) $Customer->family = $family;
                if ($gender != null) $Customer->gender = ($gender == "زن") ? "female" : "male";;
                if ($ncode != null) $Customer->ncode = $ncode;
                if ($birthday != null) $Customer->birthday = $birthday;
                if ($mobile != null)
                {
                    $Customer->mobile = $mobile;
                    $Customer->mobile_verified = '0';
                    $Customer->mobile_verification_code = null;
                }
                if ($email != null) $Customer->email = $email;
                if ($ostan_id != null) $Customer->ostan_id = $ostan_id;
                if ($city_id != null) $Customer->city_id = $city_id;
                if($Customer->save())
                {
                    if ($mobile != null)
                    {
                        $customerPhone = $Customer->phones()->where("title", "main")->first();
                        $customerPhone->phone = $mobile;
                        if ($customerPhone->save())
                        {
                            DB::commit();
                            return "success";
                        }
                        DB::rollBack();
                        return "phone-failed";
                    }
                    else
                    {
                        DB::commit();
                        return "success";
                    }
                }
                DB::rollBack();
                return "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsCustomerById($id)
    {
        return DB::table("users")->where("id", "=" , $id)->exists();
    }

    public function checkExistCustomerByInfo($id,$ncode=null,$email=null,$mobile=null)
    {
        if ($ncode==null && $email==null && $mobile==null) return true;

        $query=DB::table("users");
        if ($id!=null) $query->where("id","<>",$id);
        if ($ncode!=null) $query->where("ncode",$ncode);
        if ($email!=null) $query->where("email",$email);
        if ($mobile!=null) $query->where("mobile",$mobile);
        return $query->exists();
    }

    public function search($name=null, $family=null, $mobile=null)
    {
        if ($name==null && $family==null && $mobile==null) return true;
        $query = User::withTrashed()->with(["city", "ostan"])->select("*");
        if ($name != null) $query->where("name", "like", "%".$name."%");
        if ($family != null) $query->where("family", "like", "%".$family."%");
        if ($mobile != null) $query->where("mobile", "like", "%".$mobile."%");

        if ($query->exists())
        {
            $customer = $query->get();
            return [
                "customer"=>$customer,
//                    "city"=>DB::table("cities")->where("id",$customer->city_id)->get(),
                "exchange_count" => 0,
                "karshenasi_count" => 0
            ];
        }
        return "notFound";
    }

    public function changeVerificationStatus($user_id)
    {
        if ($this->checkExistsCustomerById($user_id))
        {
            $user = $this->selectCustomerById($user_id);
            if ($user->mobile_verified=='0') $user->mobile_verified='1';else $user->mobile_verified='0';
            return $user->save();
        }
        return "user-notFound";
    }


    //////////////////////////////// relation





}
