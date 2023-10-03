<?php

namespace App\Http\Controllers\Admin\Exchange\Product\ProductRelation;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductRelation\ProductRelationRepo;

class ProductRelationController extends Controller
{
    private $productRelationRepo;
    public function __construct(ProductRelationRepo $productRelationRepo)
    {
        $this->productRelationRepo = $productRelationRepo;
    }

    /////////////////////////////////////////////////////////////////////////// Attribute


    public function getRegisterOfProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getRegisterOfProduct($product_id)]);
    }

    public function getCityOfProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getCityOfProduct($product_id)]);
    }

    public function getProductServiceOfProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getProductServiceOfProduct($product_id)]);
    }

    public function getProductPicProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getProductPicProduct($product_id)]);
    }

    public function getAttrValueOfProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getAttrValueOfProduct($product_id)]);
    }

    public function getDefaultValueProduct($product_id)
    {
        return response()->json(["status" => $this->productRelationRepo->getDefaultValueProduct($product_id)]);
    }

}
