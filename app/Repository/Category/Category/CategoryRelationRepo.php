<?php

namespace App\Repository\Category\Category;

use App\Models\Category\Category\Category;
use Illuminate\Support\Facades\DB;

class CategoryRelationRepo
{


    /////////////////////////////////////////////////////////////////////////// pre-product


    public function searchPreProductByCategory($category_id)
    {
        //todo
    }



    /////////////////////////////////////////////////////////////////////////// Attribute

    //get all attribute of Category
    public function getAllAttributeOfCategory($category_id)
    {
        if (DB::table("attributes")->where("category_id",$category_id)->exists())
        {
            return Category::where("id",$category_id)->first()->attributes;
        }
        return "notFound";
    }

    //add attribute to Category
    public function addAttributeToCategory($category_id,$title)
    {
        if (!DB::table("attributes")->where(["title"=>$title,"category_id"=>$category_id])->exists())
        {
            return (DB::table("attributes")->insert(["title"=>$title,"category_id"=>$category_id])>0) ? "success" : "failed";
        }
        return "attribute-exists";
    }

    //remove attribute from Category
    public function removeAttributeFromCategory($category_id,$title)
    {
        if (DB::table("attributes")->where(["title"=>$title,"category_id"=>$category_id])->exists())
        {
            return (DB::table("attributes")->where(["title"=>$title,"category_id"=>$category_id])->delete()>0)
                ? "success" : "failed";
        }
        return "attribute-notexists";
    }

    //attribute not have Category
    public function attributeNotHaveCategory()
    {
        return (DB::table("attributes")->count()>0) ?
            (DB::table("attributes")->where("category_id", "=", null)->get()) : "notFound";
    }


    /////////////////////////////////////////////////////////////////////////// Product

    //get all product of Category
    public function getAllProductOfCategory($category_id)
    {
        if (DB::table("products")->where("category_id", $category_id)->exists())
        {
            return DB::table("products")->where("category_id", $category_id)->get();
        }
        return "notFound";
    }

    public function addProductToCategory($category_id,$product_id)
    {
        return (DB::table("products")->where("id", "=", $product_id)
                    ->update(["category_id"=>$category_id])>0) ? "success" : "failed" ;
    }

    //remove product from Category
    public function removeProductFromCategory($category_id,$product_id)
    {
        if (DB::table("products")->where(["category_id"=>$category_id,
                                                "id"=>$product_id])->exists())
        {
            return (DB::table("products")->where(["category_id"=>$category_id,
                "id"=>$product_id])->update(["category_id"=>null])>0)?"success":"failed";
        }
        return "notFound";
    }

    //course not have Category
    public function productNotHavecategory()
    {
        if (DB::table("products")->where(["category_id"=>null])->exists())
        {
            return DB::table("products")->where(["category_id"=>null])->get();
        }
        return "notFound";
    }

    /////////////////////////////////////////////////////////////////////////// Pre Product

    //get all preProduct of Category
    public function getAllPreProductOfCategory($category_id)
    {
        if (DB::table("pre_products")->where("category_id", $category_id)->exists())
        {
            return DB::table("pre_products")->where("category_id", $category_id)->get();
        }
        return "notFound";
    }

    public function addPreProductToCategory($category_id,$preProduct_id)
    {
        return (DB::table("pre_products")->where("id", "=", $preProduct_id)
                ->update(["category_id"=>$category_id])>0) ? "success" : "failed" ;
    }

    //remove preProduct from Category
    public function removePreProductFromCategory($category_id,$preProduct_id)
    {
        if (DB::table("pre_products")->where(["category_id"=>$category_id,
            "id"=>$preProduct_id])->exists())
        {
            return (DB::table("pre_products")->where(["category_id"=>$category_id,
                    "id"=>$preProduct_id])->update(["category_id"=>null])>0)?"success":"failed";
        }
        return "notFound";
    }

    //preProduct not have Category
    public function preProductNotHavecategory()
    {
        if (DB::table("pre_products")->where(["category_id"=>null])->exists())
        {
            return DB::table("pre_products")->where(["category_id"=>null])->get();
        }
        return "notFound";
    }

}
