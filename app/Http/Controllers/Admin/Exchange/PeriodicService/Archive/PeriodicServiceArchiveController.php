<?php

namespace App\Http\Controllers\Admin\Exchange\PeriodicService\Archive;

use App\Http\Controllers\Controller;
use App\Repository\PeriodicService\Archive\PeriodicServiceArchiveRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodicServiceArchiveController extends Controller
{
    private $periodicServiceArchiveRepo;
    public function __construct(PeriodicServiceArchiveRepo $periodicServiceArchiveRepo)
    {
        $this->periodicServiceArchiveRepo=$periodicServiceArchiveRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "service_time" => 'nullable',
                "done" => 'required',
                "end" => 'nullable',
                "periodic_service_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceArchiveRepo->insertPeriodicServiceArchive(
                $request->service_time??null,
                $request->done??null,
                $request->end??null,
                $request->periodic_service_id??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->periodicServiceArchiveRepo->selectPeriodicServiceArchiveById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->periodicServiceArchiveRepo->selectAllPeriodicServiceArchive()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "service_time" => 'nullable',
                "done" => 'required',
                "end" => 'nullable',
                "periodic_service_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->periodicServiceArchiveRepo->updatePeriodicServiceArchive($id,
                $request->service_time??null,
                $request->done??null,
                $request->end??null,
                $request->periodic_service_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->periodicServiceArchiveRepo->deletePeriodicServiceDesc($id)]);
    }
}
