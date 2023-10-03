<?php

namespace App\Http\Controllers\Admin\Exchange\Exchange\AttrDefaultValueExchange;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Exchange\AttrDefaultValueExchange\AttrDefaultValueExchangeRepo;
use App\Repository\Exchange\Favorite\FavoriteRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttrDefaultValueExchangeController extends Controller
{
    private $attrValueExchangeRepo;
    public function __construct(AttrDefaultValueExchangeRepo $attrValueExchangeRepo)
    {
        $this->attrValueExchangeRepo=$attrValueExchangeRepo;
    }

    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "attribute_id" => 'required',
                "default_value_id" => 'required',
                "exchange_id" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->attrValueExchangeRepo->insertAttrValueExchange(
                $request->attribute_id??null,
                $request->default_value_id??null,
                $request->exchange_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->attrValueExchangeRepo->selectAttrValueExchangeById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->attrValueExchangeRepo->selectAllAttrValueExchanges()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "attribute_id" => 'nullable',
                "default_value_id" => 'nullable',
                "exchange_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->attrValueExchangeRepo->updateAttrValueExchange($id,
                $request->attribute_id??null,
                $request->default_value_id??null,
                $request->exchange_id??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->attrValueExchangeRepo->deleteAttrValueExchange($id)]);
    }
}
