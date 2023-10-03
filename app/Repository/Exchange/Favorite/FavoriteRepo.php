<?php

namespace App\Repository\Exchange\Favorite;

use App\Models\Exchange\Favorite\Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FavoriteRepo
{
    //////////////////////////////// Page
    public function showFavoritePageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "favorites"=>null,
        ];
        if (Favorite::where("register_user_id", "=", $user_id)->exists())
        {
            $favorites = Favorite::with(["pre_product", "register_user", "product"])
                ->where("register_user_id", "=", $user_id)->get();

            $pageInfo["count"] = DB::table("favorites")
                ->where("register_user_id", "=", $user_id)
                ->count();

            foreach ($favorites as $favorite)
            {
                $pageInfo["favorites"][] = [
                    "favorite" => $favorite
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertFavorite($description,
                                   $price, $is_exists, $product_id,
                                   $register_user_id,
                                   $pre_product_id)
    {
        $favorite = new Favorite();
        $favorite->description=$description;
        $favorite->price=$price;
        $favorite->is_exists=$is_exists;
        $favorite->product_id=$product_id;
        $favorite->register_user_id=$register_user_id;
        $favorite->pre_product_id=$pre_product_id;

        return ($favorite->save())? ["status"=>"success","result"=>$favorite]:["status"=>"failed"];
    }

    public function selectFavoriteById($id)
    {
        if ($this->checkExistsFavoriteById($id))
            return Favorite::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function selectAllFavorites()
    {
        return (Favorite::withTrashed()->get()->count()>0) ? Favorite::withTrashed()->with(["pre_product", "register_user", "product"])->get() : "notFound";
    }

    public function deleteFavorite($id)
    {
        if ($this->checkExistsFavoriteById($id))
        {
            if (DB::table("favorites")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return Favorite::where("id", $id)->delete() ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreFavorite($id)
    {
        if ($this->checkExistsFavoriteById($id))
        {
            if (DB::table("favorites")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return Favorite::withTrashed()->find($id)->restore() ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateFavorite($id, $description,
                                        $price, $is_exists, $product_id,
                                        $register_user_id,
                                        $pre_product_id)
    {
        if ($this->checkExistsFavoriteById($id))
        {
            $favorite = $this->selectFavoriteById($id);
            if ($description != null) $favorite->description=$description;
            if ($price != null) $favorite->price=$price;
            if ($is_exists != null) $favorite->is_exists=$is_exists;
            if ($product_id != null) $favorite->product_id=$product_id;
            if ($register_user_id != null) $favorite->register_user_id=$register_user_id;
            if ($pre_product_id != null) $favorite->pre_product_id=$pre_product_id;

            return ($favorite->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsFavoriteById($id)
    {
        return DB::table("favorites")->where("id", "=" , $id)->exists();
    }

    //////////////////////////////// Relation

    public function favoriteCheckStatus($favorite_id)
    {
        if ($this->checkExistsFavoriteById($favorite_id))
        {
            $favorite = $this->selectFavoriteById($favorite_id);
            if ($favorite->is_exsits == "0") return "close"; else return "open";
        }
        return "notFound";
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
