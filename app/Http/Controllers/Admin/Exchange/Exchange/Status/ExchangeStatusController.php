<?php

namespace App\Http\Controllers\Admin\Exchange\Exchange\Status;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeRepo;
use App\Repository\Exchange\Exchange\Status\ExchangeStatusRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExchangeStatusController extends Controller
{
    private $exchangeStatusRepo;
    public function __construct(ExchangeStatusRepo $exchangeStatusRepo)
    {
        $this->exchangeStatusRepo=$exchangeStatusRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',


            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeStatusRepo->insertExchangeStatus(
                $request->title??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->exchangeStatusRepo->selectExchangeStatusById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->exchangeStatusRepo->selectAllExchangeStatuses()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeStatusRepo->updateExchangeStatus($id,
                $request->title??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->exchangeStatusRepo->deleteExchangeStatus($id)]);
    }
}
