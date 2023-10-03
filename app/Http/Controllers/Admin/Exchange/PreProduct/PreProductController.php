<?php

namespace App\Http\Controllers\Admin\Exchange\PreProduct;

use App\Http\Controllers\Controller;
use App\Repository\Category\PreProduct\PreProductRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreProductController extends Controller
{
    private $preProductRepo;
    public function __construct(PreProductRepo $preProductRepo)
    {
        $this->preProductRepo=$preProductRepo;
    }

    //////////////////////////////////////////page

    public function showPreProductPageInfo()
    {
        $result = $this->preProductRepo->showPreProductPageInfo();
//        return response()->json($result);
        return View("pannel.ManageProduct.preProduct.preProduct", compact("result"));
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',
                "type" => 'required',
                "category_id" => 'required',
                "register_user_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->preProductRepo->insertPreProduct(
                $request->title,
                $request->description,
                $request->type,
                $request->category_id,
                $request->register_user_id,
            ));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->selectPreProductById($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectAllPreProduct()
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json($this->preProductRepo->selectAllPreProducts());
        }
        return response()->json(["status" => "refused"]);
    }

    public function deletePreProduct($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->deletePreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function restorePreProduct($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->restorePreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function updatePreProduct($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',
                "type" => 'required',
                "category_id" => 'required'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->preProductRepo->updatePreProduct($id,
                $request->title,
                $request->description??null,
                $request->type,
                $request->category_id
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function activeShowPreProduct($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->activeShowPreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function inActiveShowPreProduct($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->inActiveShowPreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }


    public function searchPreProductByCategory($category_id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->searchPreProductByCategory($category_id)]);
        }
        return response()->json(["status" => "refused"]);
    }


    public function getCategoryOfPreProduct($id)
    {
        if (\request()->hasHeader("accept") && \request()->header("accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->preProductRepo->getCategoryOfPreProduct($id)]);
        }
        return response()->json(["status" => "refused"]);
    }




}
