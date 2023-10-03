<?php

namespace App\Repository\Product\ProductRelation;

use App\Models\Product\Product\Product;
use Illuminate\Support\Facades\DB;

class ProductRelationRepo
{

    //////////////////////////////// Relation

    public function getRegisterOfProduct($product_id)
    {
        if (DB::table("products")->where("id", "=", $product_id)->exists())
        {
            $user_id = DB::table("products")->where("id", "=", $product_id)->first()->register_user_id;
            return DB::table("users")->where("id", "=", $user_id)->first();
        }
        return "notFound";
    }

    public function getCityOfProduct($product_id)
    {
        if (Product::where("id", $product_id)->exists())
        {
            return Product::where("id", $product_id)->first()->city;
        }
        return "notFound";
    }

    public function getProductServiceOfProduct($product_id)
    {
        if (Product::where("id", $product_id)->exists())
        {
            return Product::where("id", $product_id)->first()->product_service;
        }
        return "notFound";
    }

    public function getProductPicProduct($product_id)
    {
        if (Product::where("id", $product_id)->exists())
        {
            return Product::where("id", $product_id)->first()->pics;
        }
        return "notFound";
    }

    public function getAttrValueOfProduct($product_id)
    {
        if (Product::where("id", $product_id)->exists())
        {
            return Product::where("id", $product_id)->first()->attr_values;
        }
        return "notFound";
    }

    public function getDefaultValueProduct($product_id)
    {
        if (Product::where("id", $product_id)->exists())
        {
            return Product::where("id", $product_id)->first()->default_values;
        }
        return "notFound";
    }

}
