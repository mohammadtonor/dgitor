<?php

namespace App\Repository\Exchange\Exchange\AttrValue;


use App\Models\Exchange\Exchange\AttrValue\ExchangeAttrValue;
use Illuminate\Support\Facades\DB;

class ExchangeAttrValueRepo
{


    //////////////////////////////// CRUD

    public function insertExchangeAttrValue($value, $attribute, $exchange_id)
    {
        $exchangeAttrValue = new ExchangeAttrValue();
        $exchangeAttrValue->value=$value;
        $exchangeAttrValue->attribute=$attribute;
        $exchangeAttrValue->exchange_id=$exchange_id;

        return ($exchangeAttrValue->save()) ? ["status" => "success", "result" => $exchangeAttrValue] : ["status" => "failed"];
    }

    public function selectExchangeAttrValueById($id)
    {
        if ($this->checkExistsExchangeAttrValueById($id))
            return ExchangeAttrValue::where("id",$id)->first();
        return "notFound";
    }

    public function selectAllExchangeAttrValues()
    {
        return (ExchangeAttrValue::withTrashed()->get()->count()>0) ? ExchangeAttrValue::withTrashed()->get() : "notFound";
    }

    public function updateExchangeStatus($id, $value, $attribute, $exchange_id)
    {
        if ($this->checkExistsExchangeAttrValueById($id))
        {
            $exchangeAttrValue = $this->selectExchangeAttrValueById($id);
            if ($value != null) $exchangeAttrValue->value=$value;
            if ($attribute != null) $exchangeAttrValue->attribute=$attribute;
            if ($exchange_id != null) $exchangeAttrValue->exchange_id=$exchange_id;
            return ($exchangeAttrValue->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteExchangeAttrValue($id)
    {
        if ($this->checkExistsExchangeAttrValueById($id))
            return ExchangeAttrValue::where("id",$id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsExchangeAttrValueById($id)
    {
        return DB::table("exchange_attr_values")->where("id", "=" , $id)->exists();
    }

    //////////////////////////////// Relation

}
