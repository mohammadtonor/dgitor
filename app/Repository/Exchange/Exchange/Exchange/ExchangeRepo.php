<?php

namespace App\Repository\Exchange\Exchange\Exchange;

use App\Models\Exchange\Exchange\Exchange\Exchange;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ExchangeRepo
{
    //////////////////////////////// Page
    public function showExchangePageInfo($user_id)
    {
        $pageInfo = ["user_id" => $user_id,
            "ImFirst" => null,
            "ImSecond" => null,
            "side1_status" => "exchange-notFound",
            "side2_status" => "exchange-notFound",
        ];
        if (Exchange::where("register_user1_id", "=", $user_id)->exists()) {
            $exchanges = Exchange::where("register_user1_id", "=", $user_id)->get();
            foreach ($exchanges as $exchange) {
                $pageInfo["side1_status"] = "exchange-found";
                $pageInfo["ImFirst"][] = [
                    "id" => $exchange->id,
                    "product1_id" => $exchange->product1_id,
                    "product2_id" => $exchange->product2_id,
                    "product1" => $this->getProductName($exchange->product1_id),
                    "product2" => $this->getProductName($exchange->product2_id),
                    "category1" => $this->getProductCategory($exchange->product1_id),
                    "category2" => $this->getProductCategory($exchange->product2_id),
                    "product2Owner" => $this->getProductOwner($exchange->product2_id),
                    "desc" => $exchange->description,
                    "date" => $this->checkTimeIsNull($exchange->created_at),
                    "status" => $this->getExchangeStatus($exchange->status_id),
                    "status_id" => $exchange->status_id,
                ];
            }
        }
        if (Exchange::where("register_user2_id", "=", $user_id)->exists()) {
            $exchanges = Exchange::where("register_user2_id", "=", $user_id)->get();
            foreach ($exchanges as $exchange) {
                $pageInfo["side2_status"] = "exchange-found";
                $pageInfo["ImSecond"][] = [
                    "id" => $exchange->id,
                    "product1_id" => $exchange->product1_id,
                    "product2_id" => $exchange->product2_id,
                    "product1" => $this->getProductName($exchange->product1_id),
                    "product2" => $this->getProductName($exchange->product2_id),
                    "category1" => $this->getProductCategory($exchange->product1_id),
                    "category2" => $this->getProductCategory($exchange->product2_id),
                    "product2Owner" => $this->getProductOwner($exchange->product2_id),
                    "desc" => $exchange->description,
                    "date" => $this->checkTimeIsNull($exchange->created_at),
                    "status" => $this->getExchangeStatus($exchange->status_id),
                    "status_id" => $exchange->status_id,
                ];
            }
        }
        return $pageInfo;
    }

    public function showAllExchangePageInfo()
    {
        $pageInfo = [
            "counts" => 0,
            "data" => []
        ];
        $allExchanges = $this->selectAllExchanges();
        if ($allExchanges->count() > 0) {
            $pageInfo["counts"] = DB::table("exchanges")->count();
            foreach ($allExchanges as $exchange) {
                $pageInfo["data"][] = [
                    "id" => $exchange->id,
                    "product1_id" => $exchange->product1_id,
                    "product2_id" => $exchange->product2_id,
                    "product1" => $this->getProductName($exchange->product1_id),
                    "product2" => $this->getProductName($exchange->product2_id),
                    "desc" => $exchange->description,
                    "date" => $exchange->created_at,
                    "status" => $this->getExchangeStatus($exchange->status_id),
                    "status_id" => $exchange->status_id,
                    "price" => $exchange->price,
                    "has_expert" => $this->hasExpert($exchange->id),
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertExchange($description,
                                   $type, $done, $taamin,
                                   $has_expert, $first_side_confirm,
                                   $second_side_confirm, $is_suggested,
                                   $is_exchange, $product1_price, $product2_price, $mavotafavot, $payer_mavotafavot,
                                   $status_id, $product1_id, $product2_id,
                                   $pre_product_id,
                                   $product1_category_id, $product2_category_id, $periodic_service_id,
                                   $register_user1_id, $register_user2_id)
    {
        $exchange = new Exchange();
        $exchange->description = $description;
        $exchange->type = $type;
        $exchange->done = $done;
        $exchange->taamin = $taamin;
        $exchange->has_expert = $has_expert;
        $exchange->first_side_confirm = $first_side_confirm;
        $exchange->second_side_confirm = $second_side_confirm;
        $exchange->is_suggested = $is_suggested;
        $exchange->is_exchange = $is_exchange;
        $exchange->product1_price = $product1_price;
        $exchange->product2_price = $product2_price;
        $exchange->movotafavot = $mavotafavot;
        $exchange->payer_mavotafavot = $payer_mavotafavot;
        $exchange->status_id = $status_id;
        $exchange->product1_id = $product1_id;
        $exchange->product2_id = $product2_id;
        $exchange->pre_product_id = $pre_product_id;
        $exchange->product1_category_id = $product1_category_id;
        $exchange->product2_category_id = $product2_category_id;
        $exchange->periodic_service_id = $periodic_service_id;
        $exchange->register_user1_id = $register_user1_id;
        $exchange->register_user2_id = $register_user2_id;
        return ($exchange->save()) ? ["status" => "success", "result" => $exchange] : ["status" => "failed"];

    }

    public function selectExchangeById($id)
    {
        if ($this->checkExistsExchangeById($id))
            return Exchange::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllExchanges()
    {
        return (Exchange::withTrashed()->get()->count() > 0) ? Exchange::withTrashed()->get() : "notFound";

    }

    public function updateExchange($id, $description,
                                   $type, $done, $taamin,
                                   $has_expert, $first_side_confirm,
                                   $second_side_confirm, $is_suggested,
                                   $is_exchange, $product1_price, $product2_price, $mavotafavot, $payer_mavotafavot,
                                   $status_id, $product1_id, $product2_id,
                                   $pre_product_id,
                                   $product1_category_id, $product2_category_id, $periodic_service_id,
                                   $register_user1_id, $register_user2_id)
    {
        if ($this->checkExistsExchangeById($id)) {
            $exchange = $this->selectExchangeById($id);
            if ($description != null) $exchange->description = $description;
            if ($type != null) $exchange->type = $type;
            if ($done != null) $exchange->done = $done;
            if ($taamin != null) $exchange->taamin = $taamin;
            if ($has_expert != null) $exchange->has_expert = $has_expert;
            if ($first_side_confirm != null) $exchange->first_side_confirm = $first_side_confirm;
            if ($second_side_confirm != null) $exchange->second_side_confirm = $second_side_confirm;
            if ($is_suggested != null) $exchange->is_suggested = $is_suggested;
            if ($is_exchange != null) $exchange->is_exchange = $is_exchange;
            if ($product1_price != null) $exchange->product1_price = $product1_price;
            if ($product2_price != null) $exchange->product2_price = $product2_price;
            if ($mavotafavot != null) $exchange->movotafavot = $mavotafavot;
            if ($payer_mavotafavot != null) $exchange->payer_mavotafavot = $payer_mavotafavot;
            if ($is_exchange != null) $exchange->is_exchange = $is_exchange;
            if ($status_id != null) $exchange->status_id = $status_id;
            if ($product1_id != null) $exchange->product1_id = $product1_id;
            if ($product2_id != null) $exchange->product2_id = $product2_id;
            if ($pre_product_id != null) $exchange->pre_product_id = $pre_product_id;
            if ($product1_category_id != null) $exchange->product1_category_id = $product1_category_id;
            if ($product2_category_id != null) $exchange->product2_category_id = $product2_category_id;
            if ($periodic_service_id != null) $exchange->periodic_service_id = $periodic_service_id;
            if ($register_user1_id != null) $exchange->register_user1_id = $register_user1_id;
            if ($register_user2_id != null) $exchange->register_user2_id = $register_user2_id;

            return ($exchange->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteExchange($id)
    {
        if ($this->checkExistsExchangeById($id))
            return Exchange::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }


    // ----- write by khabbaz
    // emale takhfif roye price
    public function getFinalPrice($product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        if ($product->discount_price != null && $product->discount_percentage == null) {
            return $product->price - $product->discount_price;
        } elseif ($product->discount_price == null && $product->discount_percentage != null) {
            return $product->price - (($product->price * $product->discount_percentage) / 100);
        } else {
            return $product->price;
        }
    }


    public function addExchange(
        $description, $register_user_id, $type, $is_exchange, $product1_id, $product2_id = 0, $pre_product_id = 0
    )
    {
        if (DB::table('products')->where('id', $product1_id)->exists()) $product1 = DB::table('products')->where('id', $product1_id)->first(); else return "product1_notFound";
        if ($product2_id != 0 && DB::table('products')->where('id', $product2_id)->exists()) $product2 = DB::table('products')->where('id', $product2_id)->first(); else return "product2_notFound";
        if ($pre_product_id != 0 && DB::table('pre_products')->where('id', $pre_product_id)->exists()) $pre_product = DB::table('pre_products')->where('id', $pre_product_id)->first(); else return "preProduct_notFound";

        $exchange = new Exchange();
        $exchange->description = $description;
        $exchange->type = (string)$type; // '0' ya '1'
        $exchange->is_suggested = '1';
        $exchange->is_exchange = (string)$is_exchange; // kharid = '0' | exchange = '1' | kharid va exchange = '2'

        $exchange_product1_price = $this->getFinalPrice($product1_id);
        $exchange->product1_price = $exchange_product1_price;
        if ($product2_id != 0) {
            $exchange_product2_price = $this->getFinalPrice($product2_id);
            $exchange->product2_price = $exchange_product2_price;
            $exchange->movotafavot = ($exchange_product2_price - $exchange_product1_price < 0) ?
                $exchange_product1_price - $exchange_product2_price :
                $exchange_product2_price - $exchange_product1_price;
            $exchange->payer_movotafavot = ($exchange_product1_price != $exchange_product2_price) ? ($exchange_product1_price < $exchange_product2_price) ? '1' : '2' : null;
            $exchange->product2_id = $product2_id;
            $exchange->register_user2_id = $product2->register_user_id;
        } elseif ($pre_product_id != 0) {
            $exchange->pre_product_id = $pre_product_id;
        }
        $exchange->status_id = 1; // todo : check with Dr.
        $exchange->product1_id = $product1_id;
        $exchange->register_user1_id = $register_user_id;

        return ($exchange->save()) ? "success" : "failed";
    }

    public function confirm1_exchange($exchange_id)
    {
        if (Exchange::where('id', $exchange_id)->exists()) {
            $exchange = Exchange::where('id', $exchange_id)->first();

            $exchange->first_side_confirm = '1';
            return ($exchange->save()) ? "success" : "failed";
        } else {
            return "exhange_notFound";
        }
    }

    public function confirm2_exchange($exchange_id)
    {
        if (Exchange::where('id', $exchange_id)->exists()) {
            $exchange = Exchange::where('id', $exchange_id)->first();

            $exchange->second_side_confirm = '1';
            return ($exchange->save()) ? "success" : "failed";
        } else {
            return "exhange_notFound";
        }
    }

    public function get_payer_mavotafavot($exchange_id)
    {
        if (Exchange::where('id', $exchange_id)->exists()) {
            $exchange = Exchange::where('id', $exchange_id)->first();
            $payer_mavatafavot = $exchange->payer_mavotafavot;
            $field = 'register_user' . $payer_mavatafavot . '_id';
            return $exchange->$field;
        } else {
            return "exchange_notFound";
        }
    }

    //////////////////////////////// Operation

    public function checkExistsExchangeById($id)
    {
        return DB::table("exchanges")->where("id", "=", $id)->exists();
    }

    //////////////////////////////// Relation

    public function getProductName($product_id)
    {
        if (DB::table("products")->where("id", "=", $product_id)->exists()) {
            return DB::table("products")->where("id", "=", $product_id)->first()->title;
        }
        return "product-notFound";
    }

    public function getProductCategory($product_id)
    {
        if (DB::table("products")->where("id", "=", $product_id)->exists()) {
            $cat_id = DB::table("products")->where("id", "=", $product_id)->first()->category_id;
            if (DB::table("categories")->where("id", "=", $cat_id)->exists()) {
                return DB::table("categories")->where("id", "=", $cat_id)->first()->title;
            }
            return "category-notFound";
        }
        return "product-notFound";
    }

    public function getProductOwner($product_id)
    {
        if (DB::table("products")->where("id", "=", $product_id)->exists()) {
            $user_id = DB::table("products")->where("id", "=", $product_id)->first()->register_user_id;
            if (DB::table("users")->where("id", "=", $user_id)->exists()) {
                return DB::table("users")->where("id", "=", $user_id)->first()->name;
            }
            return "user-notFound";
        }
        return "product-notFound";
    }

    public function getExchangeStatus($status_id)
    {
        if (DB::table("exchange_statuses")->where("id", "=", $status_id)->exists())
            return DB::table("exchange_statuses")->where("id", "=", $status_id)->first()->title;
        return "notFound";
    }

    public function hasExpert($exchange_id)
    {
        if ($this->checkExistsExchangeById($exchange_id)) {
            $exchange = $this->selectExchangeById($exchange_id);
            if ($exchange->has_expert == "0") return "no_expert"; else return "has_expert";
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
