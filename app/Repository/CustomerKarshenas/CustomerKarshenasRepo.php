<?php

namespace App\Repository\CustomerKarshenas;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerKarshenasRepo
{


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////customer


    //////////////////////////////////////////////////////page

    public function showPageKarshenasOfCustomer($customer_id)
    {
        $pageInfo=[
            "count"=>0,
            "customer"=>null,
            "karshenases"=>[],
            "karshenasCanAssign"=>[]
        ];

        if(DB::table("users")->where(["id" => $customer_id, "is_cutomer" => '1'])->exists())
        {
            $pageInfo["customer"] = DB::table("users")->where(["id" => $customer_id, "is_cutomer" => '1'])->first();

            $karshenasRoleId = DB::table("roles")->where("name_en", "karshenas")->first()->id;
            $karshenasIds = DB::table("role_user")->where("role_id", $karshenasRoleId)->pluck("user_id")->toArray();

            if (DB::table("customer_karshenas")->where("customer_user_id",$customer_id)->exists())
            {
                $pageInfo["count"]=DB::table("customer_karshenas")->where("customer_user_id",$customer_id)->count();

                $pageInfo["karshenases"]=DB::table("users")
                    ->whereIn("id",DB::table("customer_karshenas")
                        ->where("customer_user_id",$customer_id)
                        ->pluck("karshenas_user_id")
                        ->toArray())
                    ->where("id", "<>", $customer_id)
                    ->whereIn("id", $karshenasIds)
                    ->get();
            }

            $pageInfo["karshenasCanAssign"]=DB::table("users")
                ->whereNotIn("id",DB::table("customer_karshenas")
                    ->where("customer_user_id",$customer_id)
                    ->pluck("karshenas_user_id")
                    ->toArray())
                ->where("id", "<>", $customer_id)
                ->whereIn("id", $karshenasIds)
                ->get();

            return $pageInfo;
        }

        return "notFound";
    }





    //////////////////////////////////////////////////////crud


    public function syncKarshenasToCustomer($customer_id,$karshenas_ids)
    {
        if ($this->checkUserExistById($customer_id))
        {
            DB::beginTransaction();

            if (DB::table("customer_karshenas")->where("customer_user_id",$customer_id)->exists())
            {
                if (DB::table("customer_karshenas")->where("customer_user_id",$customer_id)->delete()>0)
                {
                    $karshenas_count=0;

                    foreach ($karshenas_ids as $karshenas_id)
                    {
                        if (DB::table("customer_karshenas")->insert(["customer_user_id"=>$customer_id,"karshenas_user_id"=>$karshenas_id,"created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]))
                            $karshenas_count++;
                    }

                    if (count($karshenas_ids)==$karshenas_count)
                    {
                        DB::commit();
                        return  "success";
                    }
                    DB::rollBack();
                    return "failed";
                }
                DB::rollBack();
                return "failed";
            }
            else
            {
                $karshenas_count=0;

                foreach ($karshenas_ids as $karshenas_id)
                {
                    if (DB::table("customer_karshenas")->insert(["customer_user_id"=>$customer_id,"karshenas_user_id"=>$karshenas_id,"created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]))
                        $karshenas_count++;
                }

                if (count($karshenas_ids)==$karshenas_count)
                {
                    DB::commit();
                    return  "success";
                }
                DB::rollBack();
                return "failed";
            }


        }
        return "notFound";
    }








    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////karsehnas


    //////////////////////////////////////////////////////page

    public function showPageCustomerOfKarshenas($karshenas_id)
    {
        $pageInfo=[
            "count"=>0,
            "karshenas"=>null,
            "customers"=>[],
            "customerCanAssign"=>[]
        ];

        $karshenasRoleId = DB::table("roles")->where("name_en", "karshenas")->first()->id;
        $karshenasIds = DB::table("role_user")->where("role_id", $karshenasRoleId)->pluck("user_id")->toArray();

        if (DB::table("users")->where("id",$karshenas_id)->whereIn("id", $karshenasIds)->exists())
        {
            $pageInfo["karshenas"] = DB::table("users")->where("id",$karshenas_id)->whereIn("id", $karshenasIds)->first();

            if (DB::table("customer_karshenas")->where("karshenas_user_id",$karshenas_id)->exists())
            {
                $pageInfo["count"]=DB::table("customer_karshenas")->where("karshenas_user_id",$karshenas_id)->count();

                $pageInfo["customers"]=DB::table("users")->where("is_cutomer", '1')
                    ->whereIn("id",DB::table("customer_karshenas")
                        ->where("karshenas_user_id",$karshenas_id)
                        ->pluck("customer_user_id")
                        ->toArray())
                    ->where("id", "<>", $karshenas_id)
                    ->whereNotIn("id", $karshenasIds)
                    ->get();
            }

            $pageInfo["customerCanAssign"]=DB::table("users")->where("is_cutomer", '1')
                ->whereNotIn("id",DB::table("customer_karshenas")
                    ->where("karshenas_user_id",$karshenas_id)
                    ->pluck("customer_user_id")
                    ->toArray())
                ->where("id", "<>", $karshenas_id)
                ->whereNotIn("id", $karshenasIds)
                ->get();

            return $pageInfo;
        }
        return "notfound";
    }

    //////////////////////////////////////////////////////crud



    public function syncCustomerToKarshenas($karshenas_id,$customer_ids)
    {
        if ($this->checkUserExistById($karshenas_id))
        {
            DB::beginTransaction();

            if (DB::table("customer_karshenas")->where("karshenas_user_id",$karshenas_id)->exists())
            {
                if (DB::table("customer_karshenas")->where("karshenas_user_id",$karshenas_id)->delete()>0)
                {
                    $customer_count=0;

                    foreach ($customer_ids as $customer_id)
                    {
                        if (DB::table("customer_karshenas")->insert(["customer_user_id"=>$customer_id,"karshenas_user_id"=>$karshenas_id,"created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]))
                            $customer_count++;
                    }

                    if (count($customer_ids)==$customer_count)
                    {
                        DB::commit();
                        return  "success";
                    }
                    DB::rollBack();
                    return "failed";
                }
                DB::rollBack();
                return "failed";
            }
            else
            {
                $customer_count=0;

                foreach ($customer_ids as $customer_id)
                {
                    if (DB::table("customer_karshenas")->insert(["customer_user_id"=>$customer_id,"karshenas_user_id"=>$karshenas_id,"created_at"=>Carbon::now(),"updated_at"=>Carbon::now()]))
                        $customer_count++;
                }

                if (count($customer_ids)==$customer_count)
                {
                    DB::commit();
                    return  "success";
                }
                DB::rollBack();
                return "failed";
            }


        }
        return "notFound";
    }











    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////customer karshenas

    public function checkUserExistById($id)
    {
        return DB::table("users")->where("id",$id)->exists();
    }


    public function attachKarshenasToCustomer($customer_id,$karshenas_id)
    {
        if ($this->checkUserExistById($customer_id))
        {
            if (!DB::table("customer_karshenas")->where(["customer_user_id"=>$customer_id,"karsehnas_user_id"=>$karshenas_id])->exists())
            {
                return (DB::table("customer_karshenas")->insert(["customer_user_id"=>$customer_id,
                    "karshenas_id"=>$karshenas_id,
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now()])) ? "success" : "failed";
            }
            return  "exists";
        }
        return "customer-notFound";
    }


    public function detachKarshenasToCustomer($customer_id,$karshenas_id)
    {
        if ($this->checkUserExistById($customer_id))
        {
            if (DB::table("customer_karshenas")->where(["customer_user_id"=>$customer_id,"karsehnas_user_id"=>$karshenas_id])->exists())
            {
                return (DB::table("customer_karshenas")->delete(["customer_user_id"=>$customer_id,"karsehnas_user_id"=>$karshenas_id])) ? "success" : "failed";
            }
            return  "deleted";
        }
        return "customer-notFound";
    }



}
