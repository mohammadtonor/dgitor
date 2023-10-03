<?php

namespace App\Repository\Product\Product;

use App\Models\Product\Product\Product;
use Illuminate\Support\Facades\DB;

class ProductRepo
{
    //////////////////////////////// Page

    public function showProductPageInfo()
    {
        $pageInfo = [
            "count"=>0,
            "products"=>[],
        ];

        if (DB::table("products")->count()>0)
        {
            $pageInfo["count"] = DB::table("products")->count();
            $products = Product::with(["register_user", "product_service", "city", "category"])->get();
            foreach ($products as $product)
            {
                $pageInfo["products"][] = [
                    "product" => $product,
                    "ostan" => DB::table("ostans")->where("id", $product->city->ostan_id)->first()
                ];
            }
        }
        return $pageInfo;
    }

    public function showInsertPage()
    {
        $pageInfo["product_count"] = DB::table("products")->count();
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertProduct($title, $description,$show, $price,$takkhfif_price, $address,
                                  $phone, $lat, $lng,$for_sale, $city_id,$category_id, $register_user_id,
                                  $product_service_id, $pre_product_id)
    {
        $product = new Product();
        $product->title = $title;
        $product->description = $description;
        $product->show = $show;
        $product->price = $price;
        $product->takkhfif_price = $takkhfif_price;
        $product->address = $address;
        $product->phone = $phone;
        $product->lat = $lat;
        $product->lng = $lng;
        $product->for_sale = $for_sale;
        $product->city_id = $city_id;
        $product->category_id = $category_id;
        $product->register_user_id = $register_user_id;
        $product->product_service_id = $product_service_id;
        $product->pre_product_id = $pre_product_id;
        return ($product->save()) ?
            ["status" => "success", "result" => $product] :
            ["status" => "failed"];
    }

    public function insertProductStep1SelectProduct($category_id,$preProduct_id,$newProductName)
    {
        $product_array=[];
//        if (session()->has("product"))

    }

    public function insertProductStep2Attrvalues()
    {

    }


    public function selectProductById($id)
    {
        if ($this->checkExistsProductById($id))
            return Product::with(["register_user", "product_service", "city", "category"])->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllProducts()
    {
        return $this->showProductPageInfo();
    }


    public function deleteProduct($id)
    {
        if ($this->checkExistsProductById($id))
        {
            if (DB::table("products")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Product::where("id",$id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreProduct($id)
    {
        if($this->checkExistsProductById($id))
        {
            if (DB::table("products")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Product::withTrashed()->where("id", $id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }


    //todo
    public function updateProduct($id, $title, $description,
                                  $show, $price, $address,
                                  $phone, $lat, $lng,
                                  $for_sale, $active, $city_id,
                                  $category_id, $register_user_id,
                                  $product_service_id, $pre_product_id)
    {
        if ($this->checkExistsProductById($id)) {
            $product = $this->selectProductById($id);

            if ($title != null) $product->title = $title;
            if ($description != null) $product->description = $description;
            if ($show != null) $product->show = $show;
            if ($price != null) $product->price = $price;
            if ($address != null) $product->address = $address;
            if ($phone != null) $product->phone = $phone;
            if ($lat != null) $product->lat = $lat;
            if ($lng != null) $product->lng = $lng;
            if ($for_sale != null) $product->for_sale = $for_sale;
            if ($active != null) $product->active = $active;
            if ($city_id != null) $product->city_id = $city_id;
            if ($category_id != null) $product->category_id = $category_id;
            if ($register_user_id != null) $product->register_user_id = $register_user_id;
            if ($product_service_id != null) $product->product_service_id = $product_service_id;
            if ($pre_product_id != null) $product->pre_product_id = $pre_product_id;

            return ($product->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    public function search($category_id, $pre_product_id)
    {
        $query = Product::with(["register_user", "product_service", "city", "category"])->select("*");
        if ($category_id != null) $query->where("category_id", $category_id);
        if ($pre_product_id != null) $query->where("pre_product_id", $pre_product_id);

        return $query->exists() ? $query->get() : "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsProductById($id)
    {
        return DB::table("products")->where("id", "=" , $id)->exists();
    }

    public function changePrice($id,$price,$takhfif)
    {
        if ($this->checkExistsProductById($id))
        {
            $discount_percentage=($takhfif/$price)*100;
            $product=$this->selectProductById($id);
            $product->price=$price;
            $product->takhfif_price=$takhfif;
            $product->discount_percentage=$discount_percentage;

            return $product->save() ? "success" : "failed";
        }
        return "notFound";
    }


    public function changeKarshenasPrice($id,$price)
    {
        if ($this->checkExistsProductById($id))
        {
            $product=$this->selectProductById($id);
            $product->expert_price=$price;
            return $product->save() ? "success" : "failed";
        }
        return "notFound";
    }

    public function changeAddress($id,$addr,$city_id)
    {
        if ($id==null || $city_id==null) return "failed";
        if ($this->checkExistsProductById($id))
        {
            $product=$this->selectProductById($id);
            $product->address=$addr;
            $product->city_id=$city_id;

            return $product->save() ? "success" : "failed";
        }
        return "notFound";
    }

    public function activeShowProduct($id)
    {
        if ($this->checkExistsProductById($id))
        {
            $product=$this->selectProductById($id);
            $product->show='1';
            return $product->save() ? "success" : "failed";
        }
        return "notFound";
    }

    public function inActiveShowProduct($id)
    {
        if ($this->checkExistsProductById($id))
        {
            $product=$this->selectProductById($id);
            $product->show='0';
            return $product->save() ? "success" : "failed";
        }
        return "notFound";
    }


    //////////////////////////////// Relation

    public function getRegisterOfProduct($product_id)
    {
        if ($this->checkExistsProductById($product_id))
        {
            return Product::where("id", $product_id)->first()->register_user;
        }
        return "notFound";
    }

    public function getCityOfProduct($product_id)
    {
        if ($this->checkExistsProductById($product_id))
        {
            return Product::where("id", $product_id)->first()->city;
        }
        return "notFound";
    }

    public function getProductServiceOfProduct($product_id)
    {
        if ($this->checkExistsProductById($product_id))
        {
            return Product::where("id", $product_id)->first()->product_service;
        }
        return "notFound";
    }

    public function getAttrValueOfProduct($product_id)
    {
        if ($this->checkExistsProductById($product_id))
        {
            return Product::where("id", $product_id)->first()->attr_values;
        }
        return "notFound";
    }

    public function getDefaultValueProduct($product_id)
    {
        if ($this->checkExistsProductById($product_id))
        {
            return Product::where("id", $product_id)->first()->default_values;
        }
        return "notFound";
    }

}
