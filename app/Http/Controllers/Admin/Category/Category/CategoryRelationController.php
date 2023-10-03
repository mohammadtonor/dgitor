<?php

namespace App\Http\Controllers\Admin\Category\Category;

use App\Http\Controllers\Controller;
use App\Repository\Category\Category\CategoryRelationRepo;

class CategoryRelationController extends Controller
{
    private $categoryRelationRepo;
    public function __construct(CategoryRelationRepo $categoryRelationRepo)
    {
        $this->categoryRelationRepo = $categoryRelationRepo;
    }

    /////////////////////////////////////////////////////////////////////////// tags
    /////////////////////////////////////////////////////////////////////////// Attribute

    public function getAllAttributeOfCategory($category_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->getAllAttributeOfCategory($category_id)]);
    }

    public function addAttributeToCategory($category_id,$title)
    {
        return response()->json(["status" => $this->categoryRelationRepo->addAttributeToCategory($category_id,$title)]);
    }

    public function removeAttributeFromCategory($category_id,$title)
    {
        return response()->json(["status" => $this->categoryRelationRepo->removeAttributeFromCategory($category_id,$title)]);
    }

    public function attributeNotHaveCategory()
    {
        return response()->json(["status" => $this->categoryRelationRepo->attributeNotHaveCategory()]);
    }

    /////////////////////////////////////////////////////////////////////////// Product

    public function getAllProductOfCategory($category_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->getAllProductOfCategory($category_id)]);
    }

    public function addProductToCategory($category_id,$product_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->addProductToCategory($category_id,$product_id)]);
    }

    public function removeProductFromCategory($category_id,$product_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->removeProductFromCategory($category_id,$product_id)]);
    }

    public function productNotHavecategory()
    {
        return response()->json(["status" => $this->categoryRelationRepo->productNotHavecategory()]);
    }

    /////////////////////////////////////////////////////////////////////////// Pre Product

    public function getAllPreProductOfCategory($category_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->getAllPreProductOfCategory($category_id)]);
    }

    public function addPreProductToCategory($category_id,$preProduct_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->addPreProductToCategory($category_id,$preProduct_id)]);
    }

    public function removePreProductFromCategory($category_id,$preProduct_id)
    {
        return response()->json(["status" => $this->categoryRelationRepo->removePreProductFromCategory($category_id,$preProduct_id)]);
    }

    public function preProductNotHavecategory()
    {
        return response()->json(["status" => $this->categoryRelationRepo->preProductNotHavecategory()]);
    }

}
