<?php

namespace App\Repository\Product\AttrValue;

use App\Models\Product\AttrValue\ProductAttrValue;
use Illuminate\Support\Facades\DB;

class ProductAttrValueRepo
{

    public function showProductAttrValuePageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "attr_value" => [],
        ];

        if (ProductAttrValue::Where("register_user_id", $user_id)->exists())
        {
            $pageInfo["count"] = ProductAttrValue::Where("register_user_id", $user_id)->count();
            $productAttrValues = ProductAttrValue::Where("register_user_id", $user_id)->with(["product", "register_user"])->get();
            foreach ($productAttrValues as $productAttrValue)
            {
                $pageInfo["attr_value"][] = [
                    "productAttrValue" => $productAttrValue
                    ];
            }

        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertProductAttrValue($value, $attribute, $register_user_id, $product_id)
    {
        $productAttrValue = new ProductAttrValue();
        $productAttrValue->value = $value;
        $productAttrValue->attribute = $attribute;
        $productAttrValue->register_user_id = $register_user_id;
        $productAttrValue->product_id = $product_id;

        return ($productAttrValue->save()) ? ["status" => "success", "result" => $productAttrValue] : ["status" => "failed"];
    }

    public function selectProductAttrValueById($id)
    {
        if ($this->checkExistsProductAttrValueById($id))
            return ProductAttrValue::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllProductAttrValues()
    {
        return (ProductAttrValue::withTrashed()->with(["product", "register_user"])->get()->count()>0) ? ProductAttrValue::withTrashed()->get() : "notFound";
    }

    public function deleteExperting($id)
    {
        if ($this->checkExistsProductAttrValueById($id))
        {
            if (DB::table("product_attr_values")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ProductAttrValue::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreExperting($id)
    {
        if ($this->checkExistsProductAttrValueById($id))
        {
            if (DB::table("product_attr_values")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return ProductAttrValue::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateProductAttrValue($id, $value, $attribute, $register_user_id, $product_id)
    {
        if ($this->checkExistsProductAttrValueById($id)) {
            $productAttrValue = $this->selectProductAttrValueById($id);
            if ($value != null ) $productAttrValue->value = $value;
            if ($attribute != null ) $productAttrValue->attribute = $attribute;
            if ($register_user_id != null ) $productAttrValue->register_user_id = $register_user_id;
            if ($product_id != null ) $productAttrValue->product_id = $product_id;
            return ($productAttrValue->save()) ? "success" : "failed";
        } else {
            return "notFound";
        }
    }

    //////////////////////////////// Operation

    public function checkExistsProductAttrValueById($id)
    {
        return DB::table("product_attr_values")->where("id", "=" , $id)->exists();
    }

    //////////////////////////////// Relation

    public function getAllAttributeOfProduct($product_id)
    {
        if (ProductAttrValue::where("product_id", $product_id)->exists())
            return ProductAttrValue::where("product_id", $product_id)->get("attribute");
        return "notFound";
    }

    public function getRegisterUserProductAttrValue($product_attr_value_id)
    {
        if ($this->checkExistsProductAttrValueById($product_attr_value_id))
            return ProductAttrValue::where("id", $product_attr_value_id)->get("register_user_id");
        return "notFound";
    }

    public function getProductProductAttrValue($product_attr_value_id)
    {
        if ($this->checkExistsProductAttrValueById($product_attr_value_id))
            return ProductAttrValue::where("id", $product_attr_value_id)->product;
        return "notFound";
    }
}
