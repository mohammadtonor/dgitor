<?php

namespace App\Http\Controllers\Admin\Exchange\Product\AttrValue;

use App\Http\Controllers\Controller;
use App\Repository\Product\AttrValue\ProductAttrValueRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductAttrValuesController extends Controller
{
    private $productAttrValueRepo;

    public function __construct(ProductAttrValueRepo $productAttrValueRepo)
    {
        $this->productAttrValueRepo = $productAttrValueRepo;
    }

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "value" => "required",
                "attribute" => "required",
                "register_user_id" => "required",
                "product_id" => "required"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);

            return response()->json(
                $this->productAttrValueRepo->insertProductAttrValue(
                    $request->value ?? null,
                    $request->attribute ?? null,
                    $request->register_user_id ?? null,
                    $request->product_id ?? null
                )
            );
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($id)
    {
        return response()->json($this->productAttrValueRepo->selectProductAttrValueById($id));
    }

    public function selectAll()
    {
        return response()->json($this->productAttrValueRepo->selectAllProductAttrValues());
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {

            $validator = Validator::make($request->all(), [
                "value" => "nullable",
                "attribute" => "nullable",
                "register_user_id" => "nullable",
                "product_id" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);

            return response()->json(
                $this->productAttrValueRepo->updateProductAttrValue($id,
                    $request->value ?? null,
                    $request->attribute ?? null,
                    $request->register_user_id ?? null,
                    $request->product_id ?? null
                )
            );
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        return response()->json($this->productAttrValueRepo->deleteProductAttrValue($id));
    }
}
