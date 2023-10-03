<?php

namespace App\Repository\Product\DefaultValueProductRelation;

use App\Models\Category\DefaultValue\DefaultValue;
use App\Models\Product\Product\Product;
use Illuminate\Support\Facades\DB;

class DefaultValueProductRelationRepo
{

    //////////////////////////////// Relation


    public function attachDefaultValueToProduct($product_id, $default_value_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            $product=$this->getProductById($product_id);
            if(!DB::table("default_val_product")->where(["product_id"=>$product_id, "default_val_id"=>$default_value_id])->exists())
            {
                try
                {
                    $product->default_values()->attach($default_value_id);
                    return "success";
                }
                catch(\Exception $e)
                {
                    return "failed";
                }
            }
            return "defaultValProduct-exists";
        }
        return "product-notFound";
    }

    public function detachDefaultValueFromProduct($product_id, $default_value_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            $product=$this->getProductById($product_id);
            if(DB::table("default_val_product")->where(["product_id"=>$product_id, "default_val_id"=>$default_value_id])->exists())
            {
                try
                {
                    $product->default_values()->detach($default_value_id);
                    return "success";
                }
                catch(\Exception $e)
                {
                    return "failed";
                }
            }
            return "defaultValProduct-notexists";
        }
        return "product-notFound";
    }

    public function SyncDefaultValueToProduct($default_value_id, $product_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            $product=$this->getProductById($product_id);
            if(!DB::table("default_val_product")->where(["product_id"=>$product_id, "default_val_id"=>$default_value_id])->exists())
            {
                try
                {
                    $product->default_values()->sync($default_value_id);
                    return "success";
                }
                catch(\Exception $e)
                {
                    return "failed";
                }
            }
            return "defaultValProduct-exists";
        }
        return "product-notFound";
    }

    public function getAllDefaultValuesOfProduct($product_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            return (DB::table("default_val_product")->where("product_id",$product_id)->exists()) ?
                $this->getProductById($product_id)->default_values : "defaultValue-notFound";
        }
        return "product-notFound";
    }

    public function removeAllDefaultValueOfProduct($product_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            return (DB::table("default_val_product")->where("product_id",$product_id)->exists()) ?
                (DB::table("default_val_product")->where("product_id",$product_id)->delete()>0) ? "success" : "failed"
                : "defaultValue-notFound";
        }
        return "product-notFound";
    }

    public function getAllProductHasDefaultValue($default_value_id)
    {
        if ($this->checkExistsDefaultValueId($default_value_id))
        {
            $default_value=$this->getDefaultValueById($default_value_id);
            return ($default_value->products()->count() >0) ?
                $default_value->products : "product-notFound";
        }
        return "default_values-notFound";
    }

    public function checkExistsProductId($product_id)
    {
        return DB::table("products")->where("id",$product_id)->exists();
    }

    public function checkExistsDefaultValueId($default_value_id)
    {
        return DB::table("default_values")->where("id",$default_value_id)->exists();
    }

    public function getProductById($product_id)
    {
        if ($this->checkExistsProductId($product_id))
        {
            return Product::where("id",$product_id)->first();
        }
        return "notFound";
    }

    public function getDefaultValueById($default_value_id)
    {
        if ($this->checkExistsDefaultValueId($default_value_id))
        {
            return DefaultValue::where("id",$default_value_id)->first();
        }
        return "notFound";
    }

}
