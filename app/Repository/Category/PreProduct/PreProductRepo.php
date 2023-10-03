<?php

namespace App\Repository\Category\PreProduct;

use App\Models\Category\PreProduct\PreProduct;
use Illuminate\Support\Facades\DB;

class PreProductRepo
{
    //////////////////////////////// Page
    public function showPreProductPageInfo()
    {
        $pageInfo = [
            "counts" => 0,
            "preProduct_count" => DB::table("pre_products")->count(),
            "maincat_count" => DB::table("categories")->where("is_main", '1')->whereNull("category_id")->count(),
            "maincats" => DB::table("categories")->where("is_main", '1')->whereNull("category_id")->get(),
            "preProducts" => []
        ];
        if (DB::table("pre_products")->count() > 0)
        {
            $pageInfo["counts"] = DB::table("pre_products")->count();
            $preProducts = PreProduct::withTrashed()->with(["category", "register_user"])->get();
            foreach ($preProducts as $preProduct)
            {
                $pageInfo["preProducts"][] = [
                    "preProduct" => $preProduct
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPreProduct($title, $description, $type, $category_id,$register_user_id)

    {
        if (!$this->checkExistsPreProductByTitle(null, $title))
        {
            $preProduct = new PreProduct();
            $preProduct->title=$title;
            $preProduct->description=$description;
            $preProduct->type=$type;
            $preProduct->category_id=$category_id;
            $preProduct->register_user_id=$register_user_id;

            return ($preProduct->save()) ?
                ["status" => "success", "result" => $preProduct] :
                ["status" => "failed"];
        }
        return ["status" => "duplicate"];
    }

    public function selectPreProductById($id)
    {
        if ($this->checkExistsPreProductById($id))
            return PreProduct::withTrashed()->with(["category", "register_user"])->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllPreProducts()
    {
        return $this->showPreProductPageInfo();
    }

    public function deletePreProduct($id)
    {
        if ($this->checkExistsPreProductById($id))
        {
            if (DB::table("pre_products")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return PreProduct::where("id",$id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restorePreProduct($id)
    {
        if ($this->checkExistsPreProductById($id))
        {
            if (DB::table("pre_products")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return PreProduct::withTrashed()->where("id",$id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updatePreProduct($id, $title, $description, $type, $category_id)
    {
        if ($this->checkExistsPreProductById($id))
        {
            if (!$this->checkExistsPreProductByTitle($id, $title))
            {
                $preProduct = $this->selectPreProductById($id);
                if ($title != null) $preProduct->title=$title;
                if ($description != null) $preProduct->description=$description;
                if ($type != null) $preProduct->type=$type;
                if ($category_id != null) $preProduct->category_id=$category_id;

                return ($preProduct->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    public function activeShowPreProduct($attr_id)
    {
        if ($this->checkExistsPreProductById($attr_id))
        {
            $attribute = PreProduct::withTrashed()->where("id", $attr_id)->first();
            if ($attribute->show == '0')
            {
                $attribute->show='1';
                return $attribute->save() ? "success" : "failed";
            }
            return "show";
        }
        return "notFound";
    }

    public function inActiveShowPreProduct($attr_id)
    {
        if ($this->checkExistsPreProductById($attr_id))
        {
            $attribute = PreProduct::withTrashed()->where("id", $attr_id)->first();
            if ($attribute->show == '1')
            {
                $attribute->show='0';
                return $attribute->save() ? "success" : "failed";
            }
            return "notShow";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPreProductById($id)
    {
        return DB::table("pre_products")->where("id", $id)->exists();
    }

    public function checkExistsPreProductByTitle($id, $title=null)
    {
        if ($title==null) return true;
        $preProduct=DB::table("pre_products");
        if ($id!=null) $preProduct->where("id","<>",$id);
        $preProduct->where("title",$title);
        return $preProduct->exists();
    }




    public function searchPreProductByCategory($category_id)
    {
        //todo
    }


    //////////////////////////////// Relation

    public function getCategoryOfPreProduct($preProduct_id)
    {
        if ($this->checkExistsPreProductById($preProduct_id))
        {
            return ($this->selectPreProductById($preProduct_id)->category()->count()>0) ?
                $this->selectPreProductById($preProduct_id)->category : "category-notFound";
        }
        return "notFound";
    }
}
