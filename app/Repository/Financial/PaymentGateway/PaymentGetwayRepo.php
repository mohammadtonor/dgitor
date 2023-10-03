<?php

namespace App\Repository\Financial\PaymentGateway;

use App\Models\Financial\PaymentGateway\PaymentGateway;
use Illuminate\Support\Facades\DB;

class PaymentGetwayRepo
{

    ///////////////////////////////////page

    public function paymentGetwayShowPageInfo()
    {
        $pageInfo=[
            "count"=>0,
            "active_count"=>0,
            "inactive_count"=>0,
            "getways"=>[]
        ];

        if (DB::table("payment_gateways")->count()>0)
        {
            $pageInfo["count"]=DB::table("payment_gateways")->count();
            $pageInfo["active_count"]=DB::table("payment_gateways")->where("is_active","Permission")->count();
            $pageInfo["inactive_count"]=DB::table("payment_gateways")->where("is_active","0")->count();
            $pageInfo["getways"]=DB::table("payment_gateways")->get();
        }

        return $pageInfo;
    }


    ///////////////////////////////////crud

    public function insert($title,$desc, $path, $config)
    {
        if (!$this->checkExistPaymentGetwayByTitle($title))
        {
            $getway=new PaymentGateway();
            $getway->title=$title;
            $getway->description=$desc;
            $getway->path=$path;
            $getway->config=$config;
            return $getway->save() ? ["status"=>"success" ,"result"=>$getway] : ["status"=>"failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectPaymentGertwayById($id)
    {
        if ($this->checkExistPaymentGetwayById($id))
        {
            return PaymentGateway::where("id",$id)->first();
        }
        return "notFound";
    }

    public function getAllPaymentGetway()
    {
        return (PaymentGateway::all()->count()>0) ?
            PaymentGateway::all() : "notFound";
    }

    public function delete($id)
    {
        if ($this->checkExistPaymentGetwayById($id))
        {
            return (PaymentGateway::where("id",$id)->delete()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function update($id,$title,$desc, $path, $config)
    {
        if ($this->checkExistPaymentGetwayById($id))
        {
            if (!$this->checkExistPaymentGetwayByTitle($title))
            {
                $getway=$this->selectPaymentGertwayById($id);
                if ($title!=null) $getway->title=$title;
                if ($desc!=null) $getway->description=$desc;
                if ($path!=null) $getway->path=$path;
                if ($config!=null) $getway->config=$config;
                return $getway->save() ? "success" : "failed";
            }
            return  "duplicate";
        }
        return "noyFound";
    }

    ///////////////////////////////////operation

    public function checkExistPaymentGetwayById($id)
    {
        return DB::table("payment_gateways")->where("id", "=",$id)->exists();
    }

    public function checkExistPaymentGetwayByTitle($gateway_id, $title = null)
    {
        if ($title==null) return true;
        $gateway=DB::table("products");
        if ($title!=null) $gateway->where("title",$title);
        if ($gateway_id!=null) $gateway->where("id","<>",$gateway_id);
        return $gateway->exists();
    }

    public function changeGetwayActive($id,$active)
    {
        if ($this->checkExistPaymentGetwayById($id))
        {
            $getway=$this->selectPaymentGertwayById($id);
            if ($active!=null) $getway->is_active=$active;
            return $getway->save() ? "success" : "failed";
        }
        return "notFound";
    }


    ///////////////////////////////////relation


}
