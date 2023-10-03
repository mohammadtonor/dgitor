<?php

namespace App\Repository\Product\ProductService;

use App\Models\Product\ProductService\ProductService;
use Illuminate\Support\Facades\DB;

class ProductServiceRepo
{



    //////////////////////////////// page


    public function showPageInfo()
    {
        $pageInfo=[
            "count"=>0,
            "pService"=>[]
        ];

        if (DB::table("product_service")->count()>0)
        {
            $pageInfo["count"]=DB::table("product_service")->count();
            $allPservice=ProductService::withTrashed()->with(["products"])->get();

            foreach ($allPservice as $pService)
            {
                $pageInfo["pService"][]=[
                    "pService"=>$pService,
                    "product_count"=>DB::table("products")->where("product_service_id",$pService->id)->count()
                ];
            }

        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertProductService($title)
    {
        if (!$this->checkExistsProductServiceByTitle(null,$title))
        {
            $productService = new ProductService();
            $productService->title = $title;
            return ($productService->save()) ?
                ["status" => "success", "result" => $productService] :
                ["status" => "failed"];
        }
        return ["status"=>"duplicate"];
    }

    public function selectProductServiceById($id)
    {
        if ($this->checkExistsProductServiceById($id))
            return ProductService::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllProductServices()
    {
        return $this->showPageInfo();
    }


    public function deleteProductService($id)
    {
        if ($this->checkExistsProductServiceById($id))
        {
            if (DB::table("product_service")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return ProductService::where("id",$id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";

    }

    public function restoreProductService($id)
    {
        if ($this->checkExistsProductServiceById($id)){
            if (DB::table("product_service")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return ProductService::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";

    }

    public function updateProductService($id, $title)
    {
        if ($this->checkExistsProductServiceById($id)) {
            if (!$this->checkExistsProductServiceByTitle($id,$title))
            {
                $productService = $this->selectProductServiceById($id);
                $productService->title = $title;

                return ($productService->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";

    }


    //////////////////////////////// Operation

    public function checkExistsProductServiceById($id)
    {
        return DB::table("product_service")->where("id",  $id)->exists();
    }

    public function checkExistsProductServiceByTitle($productService_id, $title = null)
    {
        if ($title==null) return true;
        $productService=DB::table("product_service");
        if ($productService_id!=null) $productService->where("id","<>",$productService_id);
        $productService->where("title",$title);
        return $productService->exists();
    }

    //////////////////////////////// Relation


}
