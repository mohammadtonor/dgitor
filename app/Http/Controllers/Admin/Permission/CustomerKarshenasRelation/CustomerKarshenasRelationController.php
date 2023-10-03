<?php

namespace App\Http\Controllers\Admin\Permission\CustomerKarshenasRelation;

use App\Http\Controllers\Controller;
use App\Repository\CustomerKarshenas\CustomerKarshenasRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerKarshenasRelationController extends Controller
{
    private $customerKarshenasRelationRepo;
    public function __construct(CustomerKarshenasRepo $customerKarshenasRelationRepo)
    {
        $this->customerKarshenasRelationRepo = $customerKarshenasRelationRepo;
    }

    public function showPageCustomerOfKarshenas()
    {
//        $result = $this->customerKarshenasRelationRepo->showPageCustomerOfKarshenas($karshenas_id);
        return response()->json(["status" => $this->customerKarshenasRelationRepo->showPageCustomerOfKarshenas()]);
        // todo : return nview
    }

    public function getAllCustomerOfKarshenas($karshenas_id)
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->getAllCustomerOfKarshenas($karshenas_id)]);
    }

    public function getAllKarshenas()
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->getAllKarshenas()]);
    }

    public function getAllCustomers()
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->getAllCustomers()]);
    }

    public function syncCustomerForKarshenas($karshenas_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "customer_ids"   => 'required|array',
                "customer_ids.*"   => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->customerKarshenasRelationRepo->syncCustomerForKarshenas($karshenas_id,$request->customer_ids)]);
        }

        return  response()->json(["status"=>"refused"]);
    }

    public function attachCustomerToKarshenas(Request $request, $karshenas_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "customer_ids"   => 'required|array',
                "customer_ids.*"   => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->customerKarshenasRelationRepo->attachCustomerToKarshenas($karshenas_id, $request->customer_ids)]);
        }

        return  response()->json(["status"=>"refused"]);
    }

    public function detachCustomerFromKarshenas(Request $request, $karshenas_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "customer_ids"   => 'required|array',
                "customer_ids.*"   => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->customerKarshenasRelationRepo->detachCustomerFromKarshenas($karshenas_id,$request->customer_ids)]);
        }

        return  response()->json(["status"=>"refused"]);
    }

    public function deleteAllCustomerOfKarshenas($karshenas_id)
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->deleteAllCustomerOfKarshenas($karshenas_id)]);
    }

    public function getCustomersNotHasKarshenas($karshenas_id)
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->getCustomersNotHasKarshenas($karshenas_id)]);
    }

    public function getAllKarshenasHasCustomer($customer_id)
    {
        return response()->json(["status" => $this->customerKarshenasRelationRepo->getAllKarshenasHasCustomer($customer_id)]);
    }
}
