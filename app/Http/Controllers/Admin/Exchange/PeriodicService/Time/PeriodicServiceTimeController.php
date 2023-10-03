<?php

namespace App\Http\Controllers\Admin\Exchange\PeriodicService\Time;

use App\Http\Controllers\Controller;
use App\Repository\PeriodicService\Time\PeriodicServiceTimeRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodicServiceTimeController extends Controller
{

    private $periodicServiceTimeRepo;
    public function __construct(PeriodicServiceTimeRepo $periodicServiceTimeRepo)
    {
        $this->periodicServiceTimeRepo=$periodicServiceTimeRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "periodic_time" => 'required',
                "periodic_time_ext" => 'required',
                "how_long" => 'required',
                "periodic_service_id" => 'required',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceTimeRepo->insertPeriodicServiceTime(
                $request->periodic_time??null,
                $request->periodic_time_ext??null,
                $request->how_long??null,
                $request->periodic_service_id??null,)]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->periodicServiceTimeRepo->selectPeriodicServiceTimeById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->periodicServiceTimeRepo->selectAllPeriodicServiceTime()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "periodic_time" => 'nullable',
                "periodic_time_ext" => 'nullable',
                "how_long" => 'nullable',
                "periodic_service_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceTimeRepo->updatePeriodicServiceTime($id,
                $request->periodic_time??null,
                $request->periodic_time_ext??null,
                $request->how_long??null,
                $request->periodic_service_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->periodicServiceTimeRepo->deletePeriodicServiceTime($id)]);
    }

}
