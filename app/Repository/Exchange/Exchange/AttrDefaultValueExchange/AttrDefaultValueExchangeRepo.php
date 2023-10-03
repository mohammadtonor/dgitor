<?php

namespace App\Repository\Exchange\Exchange\AttrDefaultValueExchange;

use App\Models\Exchange\Exchange\AttrDefaultValExchange\AttrDefaultValExchange;
use Illuminate\Support\Facades\DB;

class AttrDefaultValueExchangeRepo
{

    //////////////////////////////// CRUD

    public function insertAttrValueExchange($attribute_id, $default_value_id, $exchange_id)
    {
        $attrValueExchange = new AttrDefaultValExchange();
        $attrValueExchange->attribute_id=$attribute_id;
        $attrValueExchange->default_value_id=$default_value_id;
        $attrValueExchange->exchange_id=$exchange_id;

        return ($attrValueExchange->save())? ["status"=>"success","result"=>$attrValueExchange]:["status"=>"failed"];

    }

    public function selectAttrValueExchangeById($id)
    {
        if ($this->checkExistsAttrValueExchangeById($id))
            return AttrDefaultValExchange::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllAttrValueExchanges()
    {
        return (AttrDefaultValExchange::withTrashed()->get()->count()>0) ? AttrDefaultValExchange::withTrashed()->get() : "notFound";
    }

    public function updateAttrValueExchange($id, $attribute_id, $default_value_id, $exchange_id)
    {
        if ($this->checkExistsAttrValueExchangeById($id))
        {
            $attrValueExchange = $this->selectAttrValueExchangeById($id);
            if ($attribute_id != null) $attrValueExchange->attribute_id=$attribute_id;
            if ($default_value_id != null) $attrValueExchange->default_value_id=$default_value_id;
            if ($exchange_id != null) $attrValueExchange->exchange_id=$exchange_id;

            return ($attrValueExchange->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteAttrValueExchange($id)
    {
        if ($this->checkExistsAttrValueExchangeById($id))
            return AttrDefaultValExchange::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsAttrValueExchangeById($id)
    {
        return DB::table("attribute_default_val_exchange")->where("id", "=" , $id)->exists();
    }





}
