<?php

namespace App\Http\Controllers\Admin\Organization\Holding;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Favorite\FavoriteRepo;
use App\Repository\Organization\Holding\HoldingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HoldingController extends Controller
{
    private $holdingRepo;
    public function __construct(HoldingRepo $holdingRepo)
    {
        $this->holdingRepo=$holdingRepo;
    }

    //////////////////////////////////////////page

    public function showPageInfo()
    {
        $result = $this->holdingRepo->showHoldingPageInfo();
        return response()->json(["status"=>"ok","holding"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [

                "title" => 'required',
                "description" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->holdingRepo->insertHolding(
                $request->title??null,
                $request->description??null,


            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->holdingRepo->selectHoldingById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->holdingRepo->selectAllHoldings()]);
    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "title" => 'required',
                "description" => 'nullable',

            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->holdingRepo->updateHolding($id,
                $request->title??null,
                $request->description??null,
            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function delete($id)
    {
        return response()->json(["status" => $this->holdingRepo->deleteHolding($id)]);
    }
}
