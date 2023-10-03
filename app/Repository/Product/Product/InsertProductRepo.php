<?php

namespace App\Repository\Product\Product;

use App\Models\Category\DefaultValue\DefaultValue;
use App\Models\Category\PreProduct\PreProduct;
use App\Models\Product\Product\Product;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class InsertProductRepo
{
    private $productSession = [
        "product" => [
//                "title",
//                "description",
//                "category_id",
//                "pre_product_title",
//                "pre_product_id",
        ],
        "addr"=>[
//            "city_id"=>1,
//            "addr"=>"3232323"
        ],
        "price"=>[
//            "price"=>43434,
//            "takhfif_price"=>434343
        ],
        "default-attrs" => [
//            "attrid" => "value"
        ],
        "new-attrs"=>[
//            "attrName"=>"value"
        ],
        "exchanges" => [
            "product_ids"=>[],
            "preproduct_ids"=>[]
        ]
    ];

    public function checkExistsProductSession()
    {
        return session()->has("product-session");
    }

    public function deleteProductSession()
    {
        if ($this->checkExistsProductSession())
        {
            session()->forget("product-session");
        }
        return "session-notFound";
    }

    public function createdProductSession()
    {
        session()->put("product-session", json_encode($this->productSession));
    }

    public function getProductSession()
    {
        return session()->get("product-session");
    }

    public function insertStep1AddProduct($productTitle,$category_id, $pre_product_id , $is_new_preproduct ,
                                          $newPreProductTitle,$only_exchange,$product_service)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        if ($is_new_preproduct)
        {
            $preProduct=new PreProduct();
            $preProduct->title=$newPreProductTitle;
            $preProduct->category_id=$category_id;
            if ($preProduct->save())
            {
                $productSession["product"]["title"] = $productTitle;
                $productSession["product"]["pre_product_title"] = $newPreProductTitle;
                $productSession["product"]["category_id"] = $category_id;
                $productSession["product"]["pre_product_id"] = $preProduct->id;
            }
        }
        else
        {
            if ($pre_product_id!=null)
                $preProduct=DB::table("pre_products")->where("id",$pre_product_id)->first();

            $productSession["product"]["title"] = $productTitle;
            if ($preProduct!=null) $productSession["product"]["pre_product_title"] = $preProduct->title;
            $productSession["product"]["category_id"] = $category_id;
            if ($pre_product_id!=null) $productSession["product"]["pre_product_id"] = $pre_product_id;
            $productSession["product"]["only_exchange"] = $only_exchange;
            $productSession["product"]["product_service"] = $product_service;
        }

        session()->put("product-session", json_encode($productSession));
        return "success";

    }


    //$attrValuesArrays--->[{attr_id:1,value_id:2,newvalue:"red"}]
    //$newAttrValueArrays--->[{attr_name:"one" , attr_value:"one"}]
    public function insertStep2AddAttributeWithValue($attrValuesArrays,$newAttrValueArrays)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        if (count($attrValuesArrays)>0)
        {
            $attrValuesArrays=json_decode($attrValuesArrays,true);
            foreach ($attrValuesArrays as $attrValuesArray)// default value product
            {
                if (array_key_exists("newValue",$attrValuesArray))
                {
                    $defaultValue=new DefaultValue();
                    $defaultValue->value=$attrValuesArray["newValue"];
                    $defaultValue->attribute_id=$attrValuesArray["attr_id"];
                    $defaultValue->save();

                    DB::table("default_val_product")->insert([
                                                                     "default_val_id"=>$defaultValue->id,
                                                                     "product_id"=>$productSession["product"]["pre_product_id"]
                                                                   ]);

                }
                else
                {
                    DB::table("default_val_product")->insert([
                                                                    "default_val_id"=>$attrValuesArray["value_id"],
                                                                    "product_id"=>$productSession["product"]["pre_product_id"]
                                                                ]);
                }

            }

            $productSession["default-attrs"]=$attrValuesArrays;

        }

        if (count($newAttrValueArrays)>0)
        {
            ////////////////// product_attr_values
            foreach ($newAttrValueArrays as $newAttrValueArray)
            {
                DB::table("product_attr_values")->insert([
                    "value"=>$newAttrValueArray["attr_value"],
                    "attribute"=>$newAttrValueArray["attr_name"]
                ]);
            }

            $productSession["new-attrs"]=$newAttrValueArrays;
        }

        session()->put("product-session", json_encode($productSession));
        return "success";
    }

    public function insertStep3AddLocation($city_id, $address)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        $productSession["addr"]["city_id"] = $city_id;
        $productSession["addr"]["addr"] = $address;

        session()->put("product-session", json_encode($productSession));
        return "success";

    }

    public function insertStep4AddPrice($price, $takhfif)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        $productSession["price"]["price"] = $price;
        $productSession["price"]["takhfif"] = $takhfif;

        session()->put("product-session", json_encode($productSession));
        return "success";
    }

    public function insertStep5AddExchange($product_id,$preProduct_title,$category_id)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        if ($preProduct_title==null && $category_id==null)
        {
            $preProduct=new PreProduct();
            $preProduct->title=$preProduct_title;
            $preProduct->category_id=$category_id;
            if ($preProduct->save())
            {
                array_push($productSession["exchanges"]["preproduct_ids"],$preProduct->id);
            }
        }

        if ($product_id==null)
        {
            array_push($productSession["exchanges"]["product_ids"],$product_id);
        }

        session()->put("product-session", json_encode($productSession));
        return "success";
    }

    public function insertStep5RemoveExchange($product_id)
    {
        if (!$this->checkExistsProductSession())
        {
            $this->createdProductSession();
        }
        $productSession = json_decode(session()->get("product-session"), true);

        $productSession["exchanges"]["product_ids"]=array_diff($productSession["exchanges"]["product_ids"],[$product_id]);

        session()->put("product-session", json_encode($productSession));
        return "success";
    }

    public function insertStep6tgetSession()
    {
        if ($this->checkExistsProductSession())
        {
            return json_decode(session()->get("product-session"), true);
        }
        return "session-notFound";
    }



    public function ّExchangeFinalStep($register_user_id)
    {
        if ($this->checkExistsProductSession())
        {
            $productSession = json_decode(session()->get("product-session"), true);

            DB::beginTransaction();

            $product=new Product();
            $product->title=$productSession["product"]["title"];
            $product->price=$productSession["price"]["price"];
            $product->takkhfif_price=$productSession["price"]["takhfif"];
            $product->address=$productSession["addr"]["addr"];
            $product->only_exchange=$productSession["product"]["only_exchange"];
            if(array_key_exists("pre_product_id",$productSession["product"]))$product->pre_product_id=$productSession["product"]["pre_product_id"];
            $product->city_id=$productSession["addr"]["city_id"];
            $product->category_id=$productSession["product"]["category_id"];
            $product->register_user_id=$register_user_id;
            $product->product_service_id=$productSession["product"]["product_service"];
            if ($product->save())
            {
                try
                {
                    //exchange
                    //todo:insert exchange table

                }
                catch (Exception $e)
                {
                    DB::rollBack();
                    return "exception";
                }
            }
            DB::rollBack();
            return "product-failed";
        }
        return "session-notFound";
    }






    public function getAllChildOfACategory($category_id)
    {
        $categoryIds = [];

        if (DB::table("categories")->where("id", $category_id)->exists())
        {
            $parentCat = DB::table("categories")->where("id", $category_id)->first();
            if ($parentCat->has_child == '1')
            {
                $childCats = DB::table("categories")->where("category_id", $category_id)->get();
                foreach ($childCats as $childCat)
                {
                    $categoryIds = array_merge($categoryIds, $this->getAllChildOfACategory($childCat->id));
                }
            }
            $categoryIds = array_merge($categoryIds, [$category_id]);
        }

        return $categoryIds;
    }

    public function getPreProductFromCategory($category_id)
    {
        return DB::table("pre_products")->whereIn("category_id", $this->getAllChildOfACategory($category_id))->exists() ?
            DB::table("pre_products")->whereIn("category_id", $this->getAllChildOfACategory($category_id))->get() :
            "notFound";
    }
}
