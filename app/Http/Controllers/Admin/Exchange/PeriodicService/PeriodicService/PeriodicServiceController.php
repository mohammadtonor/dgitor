<?php

namespace App\Http\Controllers\Admin\Exchange\PeriodicService\PeriodicService;

use App\Http\Controllers\Controller;
use App\Repository\PeriodicService\PeriodicService\PeriodicServiceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodicServiceController extends Controller
{
    private $periodicServiceRepo;
    public function __construct(PeriodicServiceRepo $periodicServiceRepo)
    {
        $this->periodicServiceRepo=$periodicServiceRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "start_date" => 'required',
                "end" => 'nullable',
                "product1_id" => 'required',
                "product2_id" => 'nullable',
                "pre_product_id" => 'required',
                "category_id" => 'nullable',
                "register_user_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceRepo->insertPeriodicService(
                $request->title??null,
                $request->start_date??null,
                $request->end??null,
                $request->product1_id??null,
                $request->product2_id??null,
                $request->pre_product_id??null,
                $request->category_id??null,
                $request->register_user_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->periodicServiceRepo->selectPeriodicServiceById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->periodicServiceRepo->selectAllPeriodicServices()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'nullable',
                "start_date" => 'nullable',
                "end" => 'nullable',
                "product1_id" => 'nullable',
                "product2_id" => 'nullable',
                "pre_product_id" => 'nullable',
                "category_id" => 'nullable',
                "register_user_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceRepo->updatePeriodicService($id,
                $request->title??null,
                $request->start_date??null,
                $request->end??null,
                $request->product1_id??null,
                $request->product2_id??null,
                $request->pre_product_id??null,
                $request->category_id??null,
                $request->register_user_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        return response()->json(["status" => $this->periodicServiceRepo->deletePeriodicService($id)]);
    }
}
