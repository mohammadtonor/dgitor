<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Repository\Customer\CustomerRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    private $customerRepo;
    public function __construct(CustomerRepo $customerRepo)
    {
        $this->customerRepo=$customerRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo()
    {
        $result = $this->customerRepo->showCustomerPageInfo();
//        return response()->json($result);
        return view("Pannel.ManageCustomer.CustomerList", compact('result'));
    }

    public function insertPageInfo()
    {
        $result = $this->customerRepo->insertCustomerShowPage();
//        return response()->json($result);
        return view("Pannel.ManageCustomer.CustomersInsert", compact('result'));
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'required',
                "gender" => 'nullable',
                "ncode" => 'required',
                "birthday" => 'nullable',
                "mobile" => 'required',
                "email" => 'required',
                "ostan_id" => 'required',
                "city_id" => 'required',
                "mobile_verification_code" => 'nullable',
                "postal_code" => 'nullable',
                "address" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->customerRepo->insertCustomer(
                $request->name??null,
                $request->family??null,
                $request->gender??null,
                $request->ncode??null,
                $request->birthday??null,
                $request->mobile??null,
                $request->email??null,
                $request->ostan_id??null,
                $request->city_id??null,
                $request->mobile_verification_code??null,
                $request->postal_code??null,
                $request->address??null,
            ));
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function selectById($user_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->customerRepo->selectCustomerById($user_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function getAll()
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->customerRepo->getAll()]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->customerRepo->deleteCustomer($id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function restore($user_id)
    {
        if (\request()->hasHeader("Accept") && \request()->header("Accept") == "application/json" && \request()->ajax())
        {
            return response()->json(["status" => $this->customerRepo->restoreCustomer($user_id)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'nullable',
                "gender" => 'nullable',
                "ncode" => 'nullable',
                "birthday" => 'nullable',
                "mobile" => 'nullable',
                "email" => 'nullable',
                "ostan_id" => 'nullable',
                "city_id" => 'nullable'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->customerRepo->updateCustomer($id,
                $request->name??null,
                $request->family??null,
                $request->gender??null,
                $request->ncode??null,
                $request->birthday??null,
                $request->mobile??null,
                $request->email??null,
                $request->ostan_id??null,
                $request->city_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function search(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "family" => 'nullable',
                "mobile" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->customerRepo->search(
                $request->name??null,
                $request->family??null,
                $request->mobile??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }
}
