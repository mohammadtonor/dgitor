<?php

namespace App\Http\Controllers\Admin\Exchange\Product\Product;

use App\Http\Controllers\Controller;
use App\Repository\Product\Product\ProductRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $productRepo;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function showProductPageInfo()
    {
        $result = $this->productRepo->showProductPageInfo();
 //       return response()->json(["status"=>"ok","Product"=>$result]);
//        return view("View_Name", compact('result'));
    }

    public function showInsertPage()
    {
        $result = $this->productRepo->showInsertPage();
 //       return response()->json(["status"=>"ok","Product"=>$result]);
      return view("pannel.ManageProduct.insertProduct", compact('result'));
    }

    public function insert(Request $request)
    {
//        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
//            $validator = Validator::make($request->all(), [
//                "title" => "required",
//                "description" => "nullable",
//                "show" => "required|numeric|boolean",
//                "price" => "required",
//                "address" => "required",
//                "phone" => "required",
//                "lat" => "nullable",
//                "lng" => "nullable",
//                "for_sale" => "required|numeric|boolean",
//                "active" => "required|numeric|boolean",
//                "city_id" => "required|numeric",
//                "category_id" => "required|numeric",
//                "product_service_id" => "nullable|numeric",
//                "pre_product_id" => "nullable|numeric",
//                "register_user_id" => "required"
//            ]);
//
//            if ($validator->fails())
//                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);
//
//            return response()->json(
//                $this->productRepo->insertProduct(
//                    $request->title ?? null,
//                    $request->description ?? null,
//                    $request->show ?? null,
//                    $request->price ?? null,
//                    $request->address ?? null,
//                    $request->phone ?? null,
//                    $request->lat ?? null,
//                    $request->lng ?? null,
//                    $request->for_sale ?? null,
//                    $request->active ?? null,
//                    $request->city_id ?? null,
//                    $request->category_id ?? null,
//                    $request->register_user_id ?? null,
//                    $request->product_service_id ?? null,
//                    $request->pre_product_id ?? null
//                )
//            );
//        }
//        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productRepo->selectProductById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAll()
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->productRepo->selectAllProducts());
        }
        return response()->json(["status" => "refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productRepo->deleteProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restore($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productRepo->restoreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function update($product_id, Request $request)
    {
//        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
//        {
//            $validator = Validator::make($request->all(), [
//                "title" => "nullable",
//                "description" => "nullable",
//                "show" => "nullable|numeric|boolean",
//                "price" => "nullable",
//                "address" => "nullable",
//                "phone" => "nullable",
//                "lat" => "nullable",
//                "lng" => "nullable",
//                "for_sale" => "nullable|numeric|boolean",
//                "active" => "nullable|numeric|boolean",
//                "city_id" => "nullable|numeric",
//                "category_id" => "nullable|numeric",
//                "product_service_id" => "nullable|numeric",
//                "pre_product_id" => "nullable|numeric",
//                "register_user_id" => "nullable"
//            ]);
//
//            if ($validator->fails())
//                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);
//
//            return response()->json(
//                $this->productRepo->updateProduct($product_id,
//                    $request->title ?? null,
//                    $request->description ?? null,
//                    $request->show ?? null,
//                    $request->price ?? null,
//                    $request->address ?? null,
//                    $request->phone ?? null,
//                    $request->lat ?? null,
//                    $request->lng ?? null,
//                    $request->for_sale ?? null,
//                    $request->active ?? null,
//                    $request->city_id ?? null,
//                    $request->category_id ?? null,
//                    $request->register_user_id ?? null,
//                    $request->product_service_id ?? null,
//                    $request->pre_product_id ?? null
//                )
//            );
//        }
//        return  response()->json(["status"=>"refused"]);
    }

    public function activeShow($product_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->productRepo->activeShowProduct($product_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function inactiveShow ($product_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax()) {
            return response()->json(["status" => $this->productRepo->inActiveShowProduct($product_id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function changePrice(Request $request, $product_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "price" => "required",
                "takhfif" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);
            return response()->json(["status" => $this->productRepo->changePrice($product_id,
                $request->price,
                $request->takhfif
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function changeAddress(Request $request, $product_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "address" => "required",
                "city_id" => "required",
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);
            return response()->json(["status" => $this->productRepo->changeAddress($product_id,
                $request->address,
                $request->city_id
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function searchProduct(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "category_id" => "required",
                "pre_product_id" => "nullable"
            ]);

            if ($validator->fails())
                return response()->json(["status" => "validationFailed", "data" => $validator->failed()]);

            return response()->json(["status" => $this->productRepo->search(
                $request->category_id,
                $request->pre_product_id
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

}
