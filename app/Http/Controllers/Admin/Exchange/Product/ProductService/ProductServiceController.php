<?php

namespace App\Http\Controllers\Admin\Exchange\Product\ProductService;

use App\Http\Controllers\Controller;
use App\Repository\Product\ProductService\ProductServiceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductServiceController extends Controller
{
    private $productServiceRepo;

    public function __construct(ProductServiceRepo $productServiceRepo)
    {
        $this->productServiceRepo = $productServiceRepo;
    }


    public function showProductServicePageInfo()
    {
        $result = $this->productServiceRepo->showPageInfo();
//        return response()->json($result);
        return view('Pannel.Exchange.ProductService', compact('result'));
    }

    public function insertProductService(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "title" => "required|unique:product_service"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);

            return response()->json($this->productServiceRepo->insertProductService($request->title));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectProductServiceById($id)
    {
        if (\request()->hasHeader('accept') && \request()->header('accept') == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productServiceRepo->selectProductServiceById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllProductService()
    {
        if (\request()->hasHeader('accept') && \request()->header('accept') == "application/json" && \request()->ajax())
        {
            return response()->json($this->productServiceRepo->selectAllProductServices());
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteProductService($id)
    {
        if (\request()->hasHeader('accept') && \request()->header('accept') == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productServiceRepo->deleteProductService($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restoreProductService($id)
    {
        if (\request()->hasHeader('accept') && \request()->header('accept') == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productServiceRepo->restoreProductService($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updateProductService($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => "required|unique:product_service"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);

            return response()->json(["status" => $this->productServiceRepo->updateProductService($id, $request->title)]);
        }
        return response()->json(["status" => "refused"]);
    }
}
