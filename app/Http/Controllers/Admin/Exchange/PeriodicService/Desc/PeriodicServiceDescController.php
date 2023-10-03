<?php

namespace App\Http\Controllers\Admin\Exchange\PeriodicService\Desc;

use App\Http\Controllers\Controller;
use App\Repository\PeriodicService\Desc\PeriodicServiceDescRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodicServiceDescController extends Controller
{
    private $periodicServiceDescRepo;
    public function __construct(PeriodicServiceDescRepo $periodicServiceDescRepo)
    {
        $this->periodicServiceDescRepo=$periodicServiceDescRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "desc" => 'nullable',
                "periodic_service_id" => 'required',


            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceDescRepo->insertPeriodicServiceDesc(
                $request->desc??null,
                $request->periodic_service_id??null,
)]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->periodicServiceDescRepo->selectPeriodicServiceDescById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->periodicServiceDescRepo->selectAllPeriodicServiceDesc()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "desc" => 'nullable',
                "periodic_service_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceDescRepo->updatePeriodicServiceDesc($id,
                $request->desc??null,
                $request->periodic_service_id??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->periodicServiceDescRepo->deletePeriodicServiceDesc($id)]);
    }
}
