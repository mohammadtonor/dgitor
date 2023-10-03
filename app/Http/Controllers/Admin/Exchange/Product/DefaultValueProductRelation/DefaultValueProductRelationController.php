<?php

namespace App\Http\Controllers\Admin\Exchange\Product\DefaultValueProductRelation;

use App\Http\Controllers\Controller;
use App\Repository\Product\DefaultValueProductRelation\DefaultValueProductRelationRepo;

class DefaultValueProductRelationController extends Controller
{
    private $defaultValueProductRelationRepo;
    public function __construct(DefaultValueProductRelationRepo $defaultValueProductRelationRepo)
    {
        $this->defaultValueProductRelationRepo = $defaultValueProductRelationRepo;
    }

    /////////////////////////////////////////////////////////////////////////// Attribute


    public function attachDefaultValueToProduct($product_id, $default_value_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->attachDefaultValueToProduct($default_value_id, $product_id)]);
    }

    public function detachDefaultValueFromProduct($product_id, $default_value_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->detachDefaultValueFromProduct($default_value_id, $product_id)]);
    }

    public function SyncDefaultValueToProduct($default_value_id, $product_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->SyncDefaultValueToProduct($default_value_id, $product_id)]);
    }

    public function getAllDefaultValuesOfProduct($product_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->getAllDefaultValuesOfProduct($product_id)]);
    }

    public function removeAllDefaultValueOfProduct($product_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->removeAllDefaultValueOfProduct($product_id)]);
    }

    public function getAllProductHasDefaultValue($default_value_id)
    {
        return response()->json(["status" => $this->defaultValueProductRelationRepo->getAllProductHasDefaultValue($default_value_id)]);
    }
}
