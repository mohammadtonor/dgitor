<?php

namespace App\Http\Controllers\Admin\Exchange\Exchange\Exchange;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Exchange\Exchange\ExchangeRepo;
use App\Repository\Exchange\Favorite\FavoriteRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExchangeController extends Controller
{
    private $exchangeRepo;
    public function __construct(ExchangeRepo $exchangeRepo)
    {
        $this->exchangeRepo=$exchangeRepo;
    }

    //////////////////////////////////////////page

    public function showExchangePageInfo($user_id)
    {
        $result = $this->exchangeRepo->showExchangePageInfo($user_id);
        return response()->json(["status"=>"ok","exchange"=>$result]);
        //TODO:Return View
    }

    public function showAllExchangePageInfo()
    {
        $result = $this->exchangeRepo->showAllExchangePageInfo();
        return response()->json(["status"=>"ok","alleExchange"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "description" => 'nullable',
                "type" => 'required',
                "done" => 'required',
                "taamin" => 'required',
                "has_expert" => 'required',
                "first_side_confirm" => 'required',
                "second_side_confirm" => 'required',
                "is_suggested" => 'required',
                "status_id" => 'required',
                "product1_id" => 'required',
                "product2_id" => 'nullable',
                "category_id" => 'nullable',
                "periodic_service_id" => 'nullable',
                "register_user1_id" => 'required',
                "register_user2_id" => 'required',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeRepo->insertExchange(
                $request->description??null,
                $request->type??null,
                $request->done??null,
                $request->taamin??null,
                $request->has_expert??null,
                $request->first_side_confirm??null,
                $request->second_side_confirm??null,
                $request->is_suggested??null,
                $request->status_id??null,
                $request->product1_id??null,
                $request->product2_id??null,
                $request->category_id??null,
                $request->periodic_service_id??null,
                $request->register_user1_id??null,
                $request->register_user2_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->exchangeRepo->selectExchangeById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->exchangeRepo->selectAllExchanges()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "description" => 'nullable',
                "type" => 'nullable',
                "done" => 'nullable',
                "taamin" => 'nullable',
                "has_expert" => 'nullable',
                "first_side_confirm" => 'nullable',
                "second_side_confirm" => 'nullable',
                "is_suggested" => 'nullable',
                "status_id" => 'nullable',
                "product1_id" => 'nullable',
                "product2_id" => 'nullable',
                "category_id" => 'nullable',
                "periodic_service_id" => 'nullable',
                "register_user1_id" => 'nullable',
                "register_user2_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->exchangeRepo->updateExchange($id,
                $request->description??null,
                $request->type??null,
                $request->done??null,
                $request->taamin??null,
                $request->has_expert??null,
                $request->first_side_confirm??null,
                $request->second_side_confirm??null,
                $request->is_suggested??null,
                $request->status_id??null,
                $request->product1_id??null,
                $request->product2_id??null,
                $request->category_id??null,
                $request->periodic_service_id??null,
                $request->register_user1_id??null,
                $request->register_user2_id??null,
            )]);

        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->exchangeRepo->deleteExchange($id)]);
    }
}
