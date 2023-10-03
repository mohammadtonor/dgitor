<?php

namespace App\Http\Controllers\Admin\Exchange\Product\Pic;

use App\Http\Controllers\Controller;
use App\Repository\Product\Pic\ProductPicRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductPicController extends Controller
{
    private $productPicRepo;
    public function __construct(ProductPicRepo $productPicRepo)
    {
        $this->productPicRepo=$productPicRepo;
    }

    //////////////////////////////////////////page

    public function showProductPicPageInfo($user_id)
    {
        $result = $this->productPicRepo->showProductPicPageInfo($user_id);
        return response()->json(["status"=>"ok","productPic"=>$result]);
        //TODO:Return View
    }

    //////////////////////////////////////////file-operation

    public function removePicFromProduct($id)
    {
        return response()->json(["status" => $this->productPicRepo->removeFileFromProductPic($id)]);
    }

    public function uploadPicForProduct($product_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "doc_file" => 'required|file',
                "uploader_user_id" => 'required'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->productPicRepo->uploadFileForProductPic($product_id,
                $request->uploader_user_id,
                $request->doc_file)]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function getPicOfProduct($productPic_id)
    {
        return response()->json(["status" => $this->productPicRepo->getFileOfProductPic($productPic_id)]);
    }
}
