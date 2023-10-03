<?php

namespace App\Repository\Product\Pic;


use App\Models\Product\Pic\ProductPic;
use App\Repository\Utility\FileManagerRepo;
use Illuminate\Support\Facades\DB;

class ProductPicRepo
{
    public $productPic = "/image/Product/";

    public function showProductPicPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "pics" => [],
        ];

        if (ProductPic::Where("register_user_id", $user_id)->exists())
        {
            $pageInfo["count"] = ProductPic::Where("register_user_id", $user_id)->count();
            $productPics = ProductPic::with(["product", "register_user"])
                ->Where("register_user_id", $user_id)
                ->get();
            foreach ($productPics as $productPic)
            {
                $pageInfo["pics"][] = [
                    "pic" => $productPic
                ];
            }

        }
        return $pageInfo;
    }

    public function deleteProductPic($id)
    {
        if ($this->checkExistsProductPicById($id))
        {
            if (DB::table("product_pics")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return DB::table("product_pics")->where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsProductPicById($id)
    {
        return DB::table("product_pics")->where("id", "=" , $id)->exists();
    }

    //////////////file operation

    public function removeFileFromProductPic($id)
    {
        $file_path = DB::table("product_pics")->where("id",$id)->first()->path;
        $removeFile = new FileManagerRepo();
        if ($removeFile->removeFileFromStorage($file_path) == "success")
        {
            if ($this->deleteProductPic($id) == "success")
                return 'remove-success';
            return "path-delete-failed";
        }
        return 'remove-failed';
    }

    public function uploadFileForProductPic($product_id,$register_user_id, $doc_file)
    {
        if (DB::table("product_pics")->where("id",$product_id)->exists())
        {
            $upload_file = new FileManagerRepo();
            if ($doc_file)
            {
                $result = $upload_file->insertFile($doc_file,$this->productPic.$product_id);
                if ($result["status"] == "ok")
                {
                    $userTaskFile = new ProductPic();
                    $userTaskFile -> path = $result["path"]."/".$result["filename"];
                    $userTaskFile -> product_id = $product_id;
                    $userTaskFile -> extension = $result["extension"];
                    $userTaskFile -> register_user_id = $register_user_id;

                    if ($userTaskFile->save())
                    {
                        return [
                            "status" => "success",
                            "path" => $result["path"]."/".$result["filename"]
                        ];
                    }
                    return ["status" => "failed", "path" => null];
                }
                return ["status" => "upload-failed", "path" => null];
            }
            return ["status" => "image-notExists", "path" => null];
        }
        return ["status" => "productPic-notFound", "path" => null];

    }

    public function getPicOfProductPic($productPic_id)
    {
        if (DB::table("product_pics")->where("id",$productPic_id)->exists())
        {
            $file_path_array = DB::table("product_pics")->where("id", $productPic_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->download($path);
            return "file-notFound";
        }
        return "notFound";
    }

    public function getBase64PicOfProductPic($productPic_id)
    {
        if (DB::table("product_pics")->where("id",$productPic_id)->exists())
        {
            $file_path_array = DB::table("product_pics")->where("id", $productPic_id)->first();
            $path = $file_path_array->path;
            $fileManager = new FileManagerRepo();
            if ($path != null)
                return $fileManager->getFileContentAsBase64($path);
            return "file-notFound";
        }
        return "notFound";
    }
    ////////////////////////////////////////relation

}
