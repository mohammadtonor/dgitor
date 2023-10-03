<?php

namespace App\Http\Controllers\Admin\Exchange\Favorite;

use App\Http\Controllers\Controller;
use App\Repository\Exchange\Favorite\FavoriteRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    private $favoriteRepo;
    public function __construct(FavoriteRepo $favoriteRepo)
    {
        $this->favoriteRepo=$favoriteRepo;
    }

        //////////////////////////////////////////page

    public function showFavoritePageInfo($user_id)
    {
        $result = $this->favoriteRepo->showFavoritePageInfo($user_id);
        return response()->json(["status"=>"ok","favorite"=>$result]);
        //TODO:Return View
    }
    //////////////////////////////////////////crud

    public function insert(Request $request)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "description" => 'nullable',
                "price" => 'required',
                "is_exists" => 'nullable',
                "product_id" => 'required',
                "register_user_id" => 'required',
                "pre_product_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->favoriteRepo->insertFavorite(
                $request->description??null,
                $request->price??null,
                $request->is_exists??null,
                $request->product_id??null,
                $request->register_user_id??null,
                $request->pre_product_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);

    }

    public function selectById($id)
    {
        return response()->json(["status" => $this->favoriteRepo->selectFavoriteById($id)]);
    }

    public function selectAll()
    {
        return response()->json(["status" => $this->favoriteRepo->selectAllFavorites()]);

    }

    public function update($id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "description" => 'nullable',
                "price" => 'nullable',
                "is_exists" => 'nullable',
                "product_id" => 'nullable',
                "register_user_id" => 'nullable',
                "pre_product_id" => 'nullable',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->favoriteRepo->updateFavorite($id,
                $request->description??null,
                $request->price??null,
                $request->is_exists??null,
                $request->product_id??null,
                $request->register_user_id??null,
                $request->pre_product_id??null,

            )]);
        }
        return  response()->json(["status"=>"refused"]);


    }

    public function delete($id)
    {
        return response()->json(["status" => $this->favoriteRepo->deleteFavorite($id)]);
    }
}
