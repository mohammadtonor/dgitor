<?php

namespace App\Http\Controllers\Admin\CustomerKarshenas;

use App\Http\Controllers\Controller;
use App\Repository\CustomerKarshenas\CustomerKarshenasRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerKarsehnasController extends Controller
{
    private $customerKarshenasRepo;

    public function __construct(CustomerKarshenasRepo $customerKarshenasRepo)
    {
        $this->customerKarshenasRepo=$customerKarshenasRepo;
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////customer


    public function showPageKarshenasOfCustomer($customer_id)
    {
        $result = $this->customerKarshenasRepo->showPageKarshenasOfCustomer($customer_id);
//        return response()->json(["status" => $result]);
//        dd($result);
        return view("Pannel.Personnel.AssignMoshtarakToEmployee", compact('result'));
    }


    public function syncKarshenasToCustomer($customer_id,Request  $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "karshenas_ids" => 'required'
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->customerKarshenasRepo->syncKarshenasToCustomer($customer_id,$request->karshenas_ids)]);
        }
        return  response()->json(["status"=>"refused"]);
    }




    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////karsehnas


    public function showPageCustomerOfKarshenas($karshenas_id)
    {
        $result = $this->customerKarshenasRepo->showPageCustomerOfKarshenas($karshenas_id);
        return response()->json(["status" => $result]);
//        return view("Pannel.ManageCustomer.KarshenasanMoshtarak", compact('result'));
    }


    public function syncCustomerToKarshenas($karshenas_id,Request  $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "customer_ids" => 'required'
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->customerKarshenasRepo->syncCustomerToKarshenas($karshenas_id, $request->customer_ids)]);
        }
        return response()->json(["status" => "refused"]);
    }



}
