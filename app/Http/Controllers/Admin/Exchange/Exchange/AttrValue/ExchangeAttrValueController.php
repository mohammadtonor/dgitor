<?php

namespace App\Http\Controllers\Admin\Exchange\Exchange\AttrValue;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Exchange\AttrValue\ExchangeAttrValueRepo;
use App\Repository\Exchange\Exchange\Status\ExchangeStatusRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExchangeAttrValueController extends Controller
{
    private $exchangeAttrValueRepo;
    public function __construct(ExchangeAttrValueRepo $exchangeAttrValueRepo)
    {
        $this->exchangeAttrValueRepo=$exchangeAttrValueRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "value" => 'required',
                "attribute" => 'required',
                "exchange_id" => 'required',


            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeAttrValueRepo->insertExchangeAttrValue(
                $request->value??null,
                $request->attribute??null,
                $request->exchange_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->exchangeAttrValueRepo->selectExchangeAttrValueById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->exchangeAttrValueRepo->selectAllExchangeAttrValues()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "value" => 'required',
                "attribute" => 'required',
                "exchange_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeAttrValueRepo->updateExchangeStatus($id,
                $request->value??null,
                $request->attribute??null,
                $request->exchange_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function delete($id)
    {
        return response()->json(["status" => $this->exchangeAttrValueRepo->deleteExchangeAttrValue($id)]);
    }
}
