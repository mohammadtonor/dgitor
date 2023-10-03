<?php

namespace App\Repository\Financial\SabadKharid;

use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\Bon\UserBon;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\Purchase\DetailFin\PurchaseDetailFin;
use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use App\Models\Financial\Purchase\Order\Order;
use App\Models\Financial\Purchase\Order\OrderDetail;
use App\Models\Financial\TotalFin\TotalFin;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\TransType\TransType;
use App\Models\Financial\Wallet\UserWallet;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use App\Models\Product\Product\Product;
use App\Models\User\Address\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductSabadKharidRepo
{


    private $cardFormat = [

        "product" => [
//            "****product_id-****register_user_id"=>[
//                "count",
//                "price",
//                "total_price",
//                "final_price",
//                "product_name",
//                "description",
//                "service_for_product",
//                "takhfif_fee",
//                "takhfif_darsad",
//                "takhfif_price",
//                "takhfif_estefade",
//                "product_id",
//                "product_user_id",
//                "register_user_id",
//                "product_service_id",
//            ]

        ],
        "periodic_service" => [
////            "****periodic_service_id-****user_id"=>[

//            ]

        ],
        "experting" => [
////            "****experting_id-****register_user_id"=>[

//            ]

        ],
        "exchange" => [
////            "****exchange_id-****produc_user_value_id"=>[

//            ]

        ],
        "info" => [
            "p_count" => 0,
            "p_total_price" => 0.00,
            "p_final_price" => 0.00,

            "p_pardakht_shode" => 0,
            "p_pardakht_mande" => 0,

            "p_sum_takhfif" => 0,

            "p_wallet" => 0,
            "p_wallet_trans" => null,

            "p_bon" => 0,
            "p_bon_trans" => null,

            "p_dargah" => 0.00,
            "p_dargah_id" => null,

            "p_pouse" => 0.00,
            "p_pardakhti" => 0,
            "p_naghdi" => 0,
            "p_enteghal" => 0,

            "p_esterdadvajh" => 0,
            "p_esterdad_wallet" => 0,
            "p_esterdad_card" => 0,

            "p_totalkharid" => 0.00,

            "p_bedehkar" => 0,
            "p_bestankar" => 0,

            "user_id" => 0,
            "user_wallet" => 0,
            "user_bon" => 0,
            "p_rezerv" => 0,

            "p_order_id" => 0,

//            "products" => [
//                "count" => 0,
//                "total_price" => 0.00,
//                "final_price" => 0.00,
//
//                "pardakht_shode" => 0,
//                "pardakht_mande" => 0,
//
//                "sum_takhfif" => 0,
//
//                "wallet" => 0,
//                "wallet_trans" => null,
//
//                "bon" => 0,
//                "bon_trans" => null,
//
//                "dargah" => 0.00,
//                "dargah_id" => null,
//
//                "pouse" => 0.00,
//                "pardakhti" => 0,
//                "naghdi" => 0,
//                "enteghal" => 0,
//
//                "esterdadvajh" => 0,
//                "esterdad_wallet" => 0,
//                "esterdad_card" => 0,
//
//                "totalkharid" => 0.00,
//
//                "bedehkar" => 0,
//                "bestankar" => 0,
//
//                "user_id" => 0,
//                "user_wallet" => 0,
//                "user_bon" => 0,
//                "rezerv" => 0,
//
//                "order_id" => 0,
//            ]
        ],

        "addrs" => ["count" => 0, "active_count" => 0],
        "zaman_ersal" => ["count" => 0, "active_count" => 0],
        "peik" => ["count" => 0, "active_count" => 0],
        "esterdad" => ["count" => 0, "active_count" => 0]
    ];

    //check exist session for sabad
    public function checkExistCardSession()
    {
        return session()->has("card");
    }

    //create session card
    public function createCardSession($user_id)
    {
        $this->cardFormat["info"]["user_id"] = $user_id;
        $this->cardFormat["info"]["user_wallet"] = !is_null($user_id) ? UserWallet::where("user_id", $user_id)->first()->mojodi : null;
        $this->cardFormat["info"]["user_bon"] = !is_null($user_id) ? UserBon::where("user_id", $user_id)->exists() ? UserBon::where("user_id", $user_id)->first()->cost : null : null;
        session()->put("card", json_encode($this->cardFormat));
    }

    public function getAllCard()
    {
        if (session()->has("card"))
            return json_decode(session()->get("card"), true);
        return "notFound";
    }

    //get price of product_user
    public function getPriceOfProductUser($product_id)
    {
        return Product::where("id", $product_id)->first()->price;
    }

    public function getTakhfifFee($product_id)
    {
        $takhfif_darsad = $this->getTakhfifpersentOfProduct($product_id);
        $takhfif_price = $this->getTakhfifPriceOfProduct($product_id);
        $kala_price = $this->getPriceOfProductUser($product_id);
        return ($takhfif_darsad == 0) ? $takhfif_price : ($kala_price * $takhfif_darsad) / 100;
    }

    public function getTakhfifPriceOfProduct($product_id)
    {
        return Product::where("id", $product_id)->first()->discount_price;
    }

    public function getTakhfifpersentOfProduct($product_id)
    {
        return Product::where("id", $product_id)->first()->discount_percentage;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //check exist product in card session
    public function checkExistProductUserInSession($product_id)
    {
        $card_array = json_decode(session()->get("card"));
        if (array_key_exists($card_array["product"]) && count($card_array["product"]) > 0) {
            foreach (array_keys($card_array["product"]) as $key) {
                if (ltrim(substr($key, 0, 6), "*") == $product_id) {
                    return true;
                    break;
                }
            }
            return false;
        }
        return false;
    }

    //add product to card session
    //@bargard ==> check userlevel
    public function addProductToCardSession($product_id, $count, $register_user_id) //ok
    {
        if (!$this->checkExistCardSession())
            $this->createCardSession($register_user_id);

        $key = str_pad($product_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
        $card_array = json_decode(session()->get("card"), true);

        $product_id = Product::where("id", $product_id)->first()->id;

        $product = Product::where("id", $product_id)->first();

        if (!array_key_exists("product", $card_array))
            $card_array["product"] = [];


        $specKala_price = $this->getPriceOfProductUser($product_id);
        $specKala_takhfif_fee = $this->getTakhfifFee($product_id);
        $specKala_takhfif_price = $this->getTakhfifPriceOfProduct($product_id);
        $specKala_takhfif_darsad = $this->getTakhfifpersentOfProduct($product_id);

        if (array_key_exists($key, $card_array["p_product"])) {
            $specKala = $card_array["product"][$key];

            $specKala_count = $specKala["count"] + $count;

            $specKala_total_price = $specKala_count * $specKala_price;

            $specKala_takhfif_estefade = $specKala_count * $specKala_takhfif_fee;

            ///////////////////////////////////////////////////////

            $card_array["info"]["p_count"] += $count;

            if ($specKala['price'] == $specKala_price) {
                $card_array["info"]["p_total_price"] += ($count * $specKala_price);

                if ($specKala['takhfif_fee'] == $specKala_takhfif_fee) {
                    $card_array["info"]["p_final_price"] += (($count * $specKala_price) - ($count * $specKala_takhfif_fee));
                    $card_array["info"]["p_pardakht_mande"] += (($count * $specKala_price) - ($count * $specKala_takhfif_fee));
                    $card_array["info"]["p_bedehkar"] += (($count * $specKala_price) - ($count * $specKala_takhfif_fee));
                    $card_array["info"]["p_sum_takhfif"] += ($count * $specKala_takhfif_fee);
                    $card_array["info"]["p_totalkharid"] += (($count * $specKala_price) - ($count * $specKala_takhfif_fee));
                } else {
                    $card_array["info"]["p_final_price"] -= (($specKala['count'] * $specKala_price) - ($specKala['count'] * $specKala['takhfif_fee']));
                    $card_array["info"]["p_pardakht_mande"] -= (($specKala['count'] * $specKala_price) - ($specKala['count'] * $specKala['takhfif_fee']));
                    $card_array["info"]["p_bedehkar"] -= (($specKala['count'] * $specKala_price) - ($specKala['count'] * $specKala['takhfif_fee']));
                    $card_array["info"]["p_sum_takhfif"] -= ($specKala['count'] * $specKala['takhfif_fee']);
                    $card_array["info"]["p_totalkharid"] -= (($specKala['count'] * $specKala_price) - ($specKala['count'] * $specKala['takhfif_fee']));

                    $card_array["info"]["p_final_price"] += $specKala_total_price - $specKala_takhfif_estefade;
                    $card_array["info"]["p_pardakht_mande"] += $specKala_total_price - $specKala_takhfif_estefade;
                    $card_array["info"]["p_bedehkar"] += $specKala_total_price - $specKala_takhfif_estefade;
                    $card_array["info"]["p_sum_takhfif"] += $specKala_takhfif_estefade;
                    $card_array["info"]["p_totalkharid"] += $specKala_total_price - $specKala_takhfif_estefade;
                }

            } else {
                $card_array['info']['p_total_price'] -= $specKala['count'] * $specKala['price'];
                $card_array['info']['p_final_price'] -= $specKala['total_price'] - $specKala['takhfif_estefade'];
                $card_array['info']['p_pardakht_mande'] -= $specKala['total_price'] - $specKala['takhfif_estefade'];
                $card_array['info']['p_bedehkar'] -= $specKala['total_price'] - $specKala['takhfif_estefade'];
                $card_array["info"]["p_sum_takhfif"] -= ($specKala['count'] * $specKala['takhfif_fee']);
                $card_array['info']['p_totalkharid'] -= $specKala['total_price'] - $specKala['takhfif_estefade'];

                $card_array["info"]["p_total_price"] += $specKala_total_price;
                $card_array["info"]["p_final_price"] += $specKala_total_price - $specKala_takhfif_estefade;
                $card_array["info"]["p_pardakht_mande"] += $specKala_total_price - $specKala_takhfif_estefade;
                $card_array["info"]["p_bedehkar"] += $specKala_total_price - $specKala_takhfif_estefade;
                $card_array["info"]["p_sum_takhfif"] += $specKala_takhfif_estefade;
                $card_array["info"]["p_totalkharid"] += $specKala_total_price - $specKala_takhfif_estefade;
            }

            $specKala["count"] = $specKala_count;
            $specKala["price"] = $specKala_price;
            $specKala["total_price"] = $specKala_total_price;
            $specKala["final_price"] = $specKala_total_price - $specKala_takhfif_estefade;
            $specKala["product_name"] = $product->title;
            $specKala["description"] = $product->description;

            $specKala["takhfif_fee"] = $specKala_takhfif_fee;
            $specKala["takhfif_estefade"] = $specKala_takhfif_estefade;
            $specKala["takhfif_darsad"] = $specKala_takhfif_darsad;
            $specKala["takhfif_price"] = $specKala_takhfif_price;

            $specKala['product_id'] = $product_id;
            $specKala["product_user_id"] = $product_id;
            $specKala["register_user_id"] = $register_user_id;

            $card_array["product"][$key] = $specKala;

            //////////////////////////////////////////////////////////////////////

            session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        } else  ///////////// if kala key does not exists in card-session
        {
            $specKala = [];
            $specKala_count = $count;

            $specKala_total_price = $specKala_price * $specKala_count;

            $specKala_takhfif_estefade = $specKala_takhfif_fee * $specKala_count;

            ///////////////////////////////////////////////////////

            $card_array["info"]["p_count"] += $count;

            $card_array["info"]["p_total_price"] += ($count * $specKala_price);
            $card_array["info"]["p_final_price"] += ($specKala_total_price - $specKala_takhfif_estefade);
            $card_array["info"]["p_pardakht_mande"] += ($specKala_total_price - $specKala_takhfif_estefade);
            $card_array["info"]["p_bedehkar"] += ($specKala_total_price - $specKala_takhfif_estefade);
            $card_array["info"]["p_sum_takhfif"] += $specKala_takhfif_estefade;
            $card_array["info"]["p_totalkharid"] += ($specKala_total_price - $specKala_takhfif_estefade);

            $specKala["count"] = $specKala_count;
            $specKala["price"] = $specKala_price;
            $specKala["total_price"] = $specKala_total_price;
            $specKala["final_price"] = $specKala_total_price - $specKala_takhfif_estefade;
            $specKala["product_name"] = $product->title;
            $specKala["description"] = $product->description;

            $specKala["takhfif_fee"] = $specKala_takhfif_fee;
            $specKala["takhfif_estefade"] = $specKala_takhfif_estefade;
            $specKala["takhfif_darsad"] = $specKala_takhfif_darsad;
            $specKala["takhfif_price"] = $specKala_takhfif_price;

            $specKala['product_id'] = $product_id;
            $specKala["product_user_id"] = $product_id;
            $specKala['register_user_id'] = $register_user_id;

            $card_array["product"][$key] = $specKala;

            //////////////////////////////////////////////////////////////////////

            session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        }

        return "success";
    }

    //increase product count
    public function incProductInSabad($product_id, $count, $register_user_id) //ok
    {
        return $this->addProductToCardSession($product_id, $count, $register_user_id);
    }

    //decrease product count
    public function decProductFromSabad($product_id, $count, $register_user_id) //ok
    {
        if (session()->has("card")) {
            $key = str_pad($product_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
            $card_array = json_decode(session()->get("card"), true);


            $product_id = Product::where("id", $product_id)->first()->id;

            $product = Product::where("id", $product_id)->first();

            if (array_key_exists($key, $card_array["product"])) {
                $specKala = $card_array["product"][$key];
                if ($specKala["count"] <= $count) $count = $specKala["count"];
                $specKala_count = $specKala["count"] - $count;
                $specKala_price = $specKala["price"];
                $specKala_total_price = $specKala["total_price"] - $count * $specKala_price;

                $specKala_takhfif_fee = $specKala["takhfif_fee"];
                $specKala_takhfif_darsad = $specKala["takhfif_darsad"];
                $specKala_takhfif_estefade = $specKala_takhfif_fee * $specKala_count;

                ///////////////////////////////////////////////////////

                $card_array["info"]["p_count"] -= $count;
                $card_array["info"]["p_total_price"] -= ($count * $specKala_price);
                $card_array["info"]["p_final_price"] -= (($count * $specKala_price) - ($specKala_takhfif_fee * $count));
                $card_array["info"]["p_pardakht_mande"] -= (($count * $specKala_price) - ($specKala_takhfif_fee * $count));
                $card_array["info"]["p_bedehkar"] -= (($count * $specKala_price) - ($specKala_takhfif_fee * $count));
                $card_array["info"]["p_sum_takhfif"] -= $specKala['takhfif_fee'] * $count;
                $card_array["info"]["p_totalkharid"] -= (($count * $specKala_price) - ($specKala_takhfif_fee * $count));

                $specKala["count"] = $specKala_count;
                $specKala["price"] = $specKala_price;
                $specKala["total_price"] = $specKala_total_price;
                $specKala["final_price"] = $specKala_total_price - $specKala_takhfif_estefade;
                $specKala["pardakht_mande"] = $specKala_total_price - $specKala_takhfif_estefade;
                $specKala["bedehkar"] = $specKala_total_price - $specKala_takhfif_estefade;

                $specKala["takhfif_fee"] = $specKala_takhfif_fee;
                $specKala["takhfif_estefade"] = $specKala_takhfif_estefade;
                $specKala["takhfif_darsad"] = $specKala_takhfif_darsad;

                $card_array["product"][$key] = $specKala;

                $specKala['product_id'] = $product_id;
                $specKala["product_user_id"] = $product_id;
                $specKala['register_user_id'] = $register_user_id;

                //////////////////////////////////////////////////////////////////////

                if ($specKala_count == 0)
                    unset($card_array["product"][$key]);

                session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
                return "success";
            }

            return "item-notFound";
        }

        return "card-notFound";
    }

    //delete product from sabad
    public function deleteProdcutFromCard($product_id, $register_user_id) //ok
    {
        if (session()->has("card")) {
            $key = str_pad($product_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
            $card_array = json_decode(session()->get("card"), true);
            $product_id = Product::where("id", $product_id)->first()->id;

            if (array_key_exists($key, $card_array["product"])) {
                $specKala = $card_array["product"][$key];
                $specKala_count = $specKala["count"];
                $specKala_total_price = $specKala["total_price"];
                $specKala_final_price = $specKala["final_price"];

                $card_array["info"]["p_count"] -= $specKala_count;
                $card_array["info"]["p_total_price"] -= $specKala_total_price;
                $card_array["info"]["p_final_price"] -= $specKala_final_price;
                $card_array["info"]["p_sum_takhfif"] -= $specKala["takhfif_estefade"];
                unset($card_array["product"][$key]);
                //////////////////////////////////////////////////////////////////////
                session()->put("card", json_encode($card_array));
                return "success";
            }
            return "failed";
        }
        return "failed";
    }

    // todo : later
    public function addErsalTimeToSabad($date, $ersalTime_ids, $exactTime)  //ersalTime=[time_id ,day,from,to]
    {
        $user_id = 1;
        $karsehans_id = 0;
        if (!$this->checkExistCardSession())
            $this->createCardSession($user_id, $karsehans_id);

        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
            $count = $card_array["zaman_ersal"]["count"];

            foreach ($ersalTime_ids as $ersalTime_id) {

                $time = "2023-07-31 10:47:31";
                $card_array["zaman_ersal"]["time" . ($count + 1)] = [
                    "time_id" => $ersalTime_id,
                    "date" => jdate($date)->format('%A, %d %B %y'),

                    "dayofweek" => 'saterday',
                    "timefrom" => '2023-08-17 14:00:00',
                    "timeto" => '2023-08-17 16:00:00',
                    "tozihat" => "",
                    "exact_string_date" => $exactTime
                ];

                $card_array["zaman_ersal"]["count"] += 1;
                $card_array["zaman_ersal"]["active_count"] += 1;
            }

            session()->put("card", json_encode($card_array));
            return [
                "status" => "ok",
                "time" => "time" . ($count + 1)
            ];
        }
        return [
            "status" => "nok"
        ];
    }

    // todo : later
    public function removeErsalTimeToSabad($time)  //ersalTime=[time_id ,day,from,to]
    {

        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
            $count = $card_array["zaman_ersal"]["count"];

            unset($card_array["zaman_ersal"][$time]);
            $card_array["zaman_ersal"]["active_count"] -= 1;


            session()->put("card", json_encode($card_array));
            return "success";
        }
        return "failed";
    }

    public function addExistErsalAddrsToSabad($ersalAddres_id)
    {
        //TODO: check by Dr.
        // if cart-session does not exist, then create it
        $user_id = Auth::id() ?? 1; // TODO: modify it
        $karsehans_id = 0; // TODO: modify it
        if (!$this->checkExistCardSession())
            $this->createCardSession($user_id, $karsehans_id);


        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            $count = $card_array["addrs"]["count"];
            $address = UserAddress::where("id", $ersalAddres_id)->first();

            $card_array["addrs"]["addr" . ($count + 1)] = [
                "addr_id" => $ersalAddres_id,
                "addr_title" => $address->title,
                "zipcode" => $address->postal_code,
                "pelak" => "",
                "status" => "active",
                "tozihat" => $address->address,
                "sabt_date" => Carbon::now()
            ];
            $card_array["addrs"]["count"] += 1;
            $card_array["addrs"]["active_count"] += 1;


            session()->put("card", json_encode($card_array));
            return [
                "status" => "ok",
                "addr" => "addr" . ($count + 1),
            ];
        }
        return [
            "status" => "nok"
        ];
    }

    public function addNewErsalAddrsToSabad($title, $city_id, $postal_code, $address)
    {
        //TODO: added check by Dr.
        // if session does not exist, create it
        $user_id = Auth::id() ?? 35;
        $karsehans_id = 0;
        if (!$this->checkExistCardSession())
            $this->createCardSession($user_id, $karsehans_id);

        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            $count = $card_array["addrs"]["count"];

            $address = new UserAddress();
            $address->title = $title;
            $address->address = $address;
            $address->postal_code = $postal_code;
            $address->city_id = $city_id;
            $address->user_id = Auth::id() ?? null;     // @todo: check by dr.

            if ($address->save()) {
                $card_array["addrs"]["addr" . ($count + 1)] = [
                    "addr_id" => $address->id,
                    "addr_title" => $title,
                    "postal_code" => $postal_code,
                    "pelak" => "",
                    "status" => "active",
                    "tozihat" => $address,
                    "sabt_date" => Carbon::now()
                ];
                $card_array["addrs"]["count"] += 1;
                $card_array["addrs"]["active_count"] += 1;

                session()->put("card", json_encode($card_array));
                return [
                    "status" => "ok",
                    "addr" => "addr" . ($count + 1),
                ];
            }
            return [
                "status" => "nok"
            ];
        }
        return [
            "status" => "nok"
        ];
    }

    public function deleteAddrfromSabad($addr)
    {
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
            unset($card_array['addrs'][$addr]);

            //TODO: added -- check by Dr.
            $card_array['addrs']["active_count"] = $card_array['addrs']["active_count"] - 1;


            session()->put("card", json_encode($card_array));
            return "success";
        }
        return "failed";
    }

    public function affectPardakhtWallet($wallet)
    {
//        if (!session()->has("card"))
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            if ($card_array["info"]["user_wallet"] >= $wallet) {
                if ($card_array["info"]["user_wallet"] != 0 || $card_array["info"]["user_wallet"] != null) {
                    if ($card_array["info"]["p_pardakht_shode"] != $card_array["info"]["p_final_price"] && $card_array["info"]["p_pardakht_mande"] != 0 ) {
                        $card_array["info"]["user_wallet"] += (intval($card_array["info"]["p_wallet"]) - intval($wallet)); // TODO: check by Dr.
                        $card_array["info"]["p_wallet"] += intval($wallet);    // TODO: check by Dr.
                        $card_array["info"]["p_pardakht_shode"] += $wallet;

                        if ($card_array["info"]["p_bedehkar"] < $wallet ) {
                            $card_array["info"]["p_pardakht_mande"] -= 0;
                            $card_array["info"]["p_bedehkar"] -= 0;
                            $card_array["info"]["p_bestankar"] += $wallet - $card_array["info"]["p_bedehkar"];
                        }else{
                            $card_array["info"]["p_pardakht_mande"] -= $wallet;
                            $card_array["info"]["p_bedehkar"] -= $wallet;
                        }

                        session()->put("card", json_encode($card_array));
                        return "success";
                    }else{
                        return "pardakht_shode";
                    }
                } else {
                    return "wallet is 0";
                }
            } else {
                return "mojodi kafi nist";
            }
        }
        return "failed";
    }

    public function affectPardakhtBon($bon)
    {
//        if (!session()->has("card"))
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            if ($card_array["info"]["user_bon"] >= $bon) {
                if ($card_array["info"]["user_bon"] != 0 || $card_array["info"]["user_bon"] != null) {
                    if ($card_array["info"]["p_pardakht_shode"] != $card_array["info"]["p_final_price"] && $card_array["info"]["p_pardakht_mande"] != 0 ){
                        $card_array["info"]["user_bon"] += (intval($card_array["info"]["p_bon"]) - intval($bon)); // TODO: check by Dr.
                        $card_array["info"]["p_bon"] += intval($bon);    // TODO: check by Dr.
                        $card_array["info"]["p_pardakht_shode"] += $bon;

                        if ($card_array["info"]["p_bedehkar"] < $bon ) {
                            $card_array["info"]["p_pardakht_mande"] -= 0;
                            $card_array["info"]["p_bedehkar"] -= 0;
                            $card_array["info"]["p_bestankar"] += $bon - $card_array["info"]["bedehkar"];
                        } else {
                            $card_array["info"]["p_pardakht_mande"] -= $bon;
                            $card_array["info"]["p_bedehkar"] -= $bon;
                        }

                        session()->put("card", json_encode($card_array));
                        return "success";
                    }else{
                        return "pardakht_shode";
                    }
                }else{
                    return "bon is 0";
                }
            } else {
                return "mojodi kafi nist";
            }
        }
        return "failed";
    }

    // todo : later
    public function affectPardakhtDargah($dargah, $dargah_id)
    {
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
            if ($card_array["info"]["p_pardakht_shode"] != $card_array["info"]["p_final_price"] && $card_array["info"]["p_pardakht_mande"] != 0 ) {
                $card_array["info"]["p_dargah"] = $dargah;   //TODO: check by Dr.
                $card_array["info"]["p_dargah_id"] = $dargah_id;
                $card_array["info"]["p_pardakht_shode"] += $dargah;

                if ($card_array["info"]["p_bedehkar"] < $dargah) {
                    $card_array["info"]["p_pardakht_mande"] -= 0;
                    $card_array["info"]["p_bedehkar"] -= 0;
                    $card_array["info"]["p_bestankar"] += $dargah - $card_array["info"]["p_bedehkar"];
                } else {
                    $card_array["info"]["p_pardakht_mande"] -= $dargah;
                    $card_array["info"]["p_bedehkar"] -= $dargah;
                }

                session()->put("card", json_encode($card_array));
                return "success";
            }else{
                return "pardakht_shode";
            }
        }
        return "failed";
    }

    //back from dargah callback and add to order and orderdetail
    public function addSabadToOrderAndOrderDetail($dargah = 0, $dargah_id = null, $info = null)
    {
        if ($this->checkExistCardSession()) {
            $sabad_info = json_decode(session()->get("card"), true);

            $info = ($info == null) ? session()->get("card") : $info;

            $count = $sabad_info["info"]["p_count"];
            $total_price = $sabad_info["info"]["p_total_price"];
            $final_price = $sabad_info["info"]["p_final_price"];

            $sum_takhfif = $sabad_info["info"]["p_sum_takhfif"];

            $wallet = $sabad_info["info"]["p_wallet"];
            $wallet_trans = $sabad_info["info"]["p_wallet_trans"];

            $bon = $sabad_info["info"]["p_bon"];
            $bon_trans = $sabad_info["info"]["p_bon_trans"];

            $dargah = ($dargah == 0) ? $sabad_info["info"]["p_dargah"] : $dargah;
            $dargah_id = ($dargah_id == null) ? $sabad_info["info"]["p_dargah_id"] : $dargah_id;

            $pouse = $sabad_info["info"]["p_pouse"];
            $pardakhti = $sabad_info["info"]["p_pardakhti"];
            $naghdi = $sabad_info["info"]["p_naghdi"];
            $enteghal = $sabad_info['info']['p_enteghal'];

            $bedehkar = $sabad_info['info']["p_bedehkar"];
            $bestankar = $sabad_info['info']["p_bestankar"];

            $esterdadvajh = $sabad_info["info"]["p_esterdadvajh"];
            $esterdad_wallet = $sabad_info["info"]["p_esterdad_wallet"];
            $esterdad_card = $sabad_info["info"]["p_esterdad_card"];

            $totalkharid = $sabad_info["info"]["p_totalkharid"];

            $customer_id = $sabad_info["info"]["user_id"] ?? 1;

            $rezerv = $sabad_info["info"]["p_rezerv"];

//            $ersaltimes = $sabad_info["zaman_ersal"]; // todo: later
//            $peik = $sabad_info["peik"]; // todo: later
//            $addrs = $sabad_info["addrs"]; // todo: later

            $info = session()->get("card");

            DB::beginTransaction();

            //create order
            $order = new Order();
            $order->status_id = Order::ORDER_OPEN;
            $order->rezerv = $rezerv;
            $order->info = $info;
            $order->user_id = $customer_id;
            if ($order->save()) {
                //create orderFins for order
                $orderFins = new PurchaseDetailFin();
                $orderFins->count = $count;
//                $orderFins->price = $price;
                $orderFins->total_price = $total_price;
                $orderFins->final_price = $final_price;

                $orderFins->dargah = $dargah;
                $orderFins->wallet = $wallet;
                $orderFins->wallet_trans = $wallet_trans;
                $orderFins->bon = $bon;
                $orderFins->bon_trans = $bon_trans;
                $orderFins->sum_takhfif = $sum_takhfif;
                $orderFins->naghdi = $naghdi;
                $orderFins->enteghal = $enteghal;
                $orderFins->pouse = $pouse;

                $orderFins->bestankar = $bestankar; // @todo: check by Dr. added.
                $orderFins->bedehkar = $bedehkar; // @todo: check by Dr. added.

                $orderFins->moghaierat = 0;
                $orderFins->esterdadvajh = 0;
                $orderFins->esterdad_wallet = 0;
                $orderFins->esterdad_card = 0;

                $orderFins->order_id = $order->id;
                if ($orderFins->save()) {
                    //add orderdetail transaction
                    $orderFinsTrans = new PurchaseDetailFinTrans();
                    $orderFinsTrans->info = $info;
                    $orderFinsTrans->count = $count;
//                    $orderFinsTrans->price = $price;
                    $orderFinsTrans->total_price = $total_price;
                    $orderFinsTrans->final_price = $final_price;
                    $orderFinsTrans->wallet = $wallet;
                    $orderFinsTrans->bon = $bon;
                    $orderFinsTrans->dargah = $dargah;
                    $orderFinsTrans->pouse = $pouse;
                    $orderFinsTrans->naghdi = $naghdi;
                    $orderFinsTrans->sum_takhfif = $sum_takhfif;
                    $orderFinsTrans->moghaierat = 0;
                    $orderFinsTrans->esterdad_wallet = 0;
                    $orderFinsTrans->esterdad_card = 0;
                    $orderFinsTrans->totalkharid = $totalkharid;
                    $orderFinsTrans->detailfin_id = $orderFins->id;
                    $orderFinsTrans->transtype_id = TransType::DARGAH;// @todo: check by Dr. added.
                    $orderFinsTrans->gateway_id = $dargah_id;

                    if ($orderFinsTrans->save()) {
                        //change totalFins
                        $totalFins = TotalFin::where("user_id", $customer_id)->first();
                        $totalFins->total_purchase += $totalkharid;
                        $totalFins->etebar_naghdi_estefade += $naghdi;
                        $totalFins->mojodi_wallet -= $wallet;
                        $totalFins->mojodi_bon -= $bon;
                        $totalFins->sum_etebar_wallet_estefade += $wallet;
                        $totalFins->sum_etebar_bon_estefade += $bon;
                        $totalFins->sum_trans_dargah += $dargah;
                        $totalFins->sum_esterdad += $esterdadvajh;
                        $totalFins->sum_pouse += $pouse;
                        $totalFins->sum_takhfif += $sum_takhfif;
                        $totalFins->totalkharid += $totalkharid;
                        $totalFins->pardakhti += ($wallet + $bon + $dargah + $naghdi - $sum_takhfif);   // @todo: check by Dr. added.
                        if ($totalFins->save()) {
                            //add totalFins transaction
                            $totalFinsTrans = new TotalFinTrans();
                            $totalFinsTrans->info = $info;
                            $totalFinsTrans->product_count = $count;
//                            $totalFinsTrans->product_price = $price;
                            $totalFinsTrans->product_total_price = $total_price;
                            $totalFinsTrans->product_final_price = $final_price;

                            $totalFinsTrans->wallet = $wallet;
                            $totalFinsTrans->bon = $bon;
                            $totalFinsTrans->dargah = $dargah;
                            $totalFinsTrans->naghdi = $naghdi;
                            $totalFinsTrans->enteghal = $enteghal;
                            $totalFinsTrans->pouse = $pouse;
                            $totalFinsTrans->sum_takhfif = $sum_takhfif;
                            $totalFinsTrans->bestankar = $bestankar;
                            $totalFinsTrans->bedehkar = $bedehkar;
                            $totalFinsTrans->totalkharid = $totalkharid;

                            $totalFinsTrans->moghaierat = 0;
                            $totalFinsTrans->esterdad_wallet = 0;
                            $totalFinsTrans->esterdad_card = 0;
                            $totalFinsTrans->purchase_detailfins_tran_id = $orderFinsTrans->id;
                            $totalFinsTrans->totalfins_id = $totalFins->id;
                            if ($totalFinsTrans->save()) {
                                //change wallet
                                $user_wallet = UserWallet::where("user_id", $customer_id)->first();
                                $wallet_first_mojodi = $user_wallet->mojodi;
                                $user_wallet->mojodi -= $wallet;

                                if ($user_wallet->save()) {
                                    //add wallet transaction
                                    $walletTrans = new UserWalletTrans();
                                    $walletTrans->info = $info;
                                    $walletTrans->price = $wallet;
                                    $walletTrans->status = "bardasht";
                                    $walletTrans->firstmojodi = $wallet_first_mojodi;
                                    $walletTrans->lastmojodi = ($wallet_first_mojodi - $wallet);
                                    $walletTrans->moghaierat = 0;
                                    $walletTrans->purchase_detailfins_tran_id = $orderFinsTrans->id;
                                    $walletTrans->user_wallet_id = $user_wallet->id;
                                    if ($walletTrans->save()) {
                                        // change bon kharid
                                        if (UserBon::where("user_id", $customer_id)->exists()){
                                            $user_bon = UserBon::where("user_id", $customer_id)->first();
                                            $bon_first_mojodi = $user_bon->cost;
                                            $user_bon->cost -= $bon;
                                            if ($user_bon->save()) {
                                                // add bon transaction
                                                $bonTrans = new UserBonTrans();
                                                $bonTrans->info = $info;
                                                $bonTrans->price = $bon;
                                                $bonTrans->status = "bardasht";
                                                $bonTrans->firstmojodi = $bon_first_mojodi;
                                                $bonTrans->lastmojodi = ($bon_first_mojodi - $bon);
                                                $bonTrans->moghaierat = 0;
                                                $bonTrans->purchase_detailfins_tran_id = $orderFinsTrans->id;
                                                $bonTrans->user_bon_id = $user_bon->id;
                                                if ($bonTrans->save()) {

                                                } else {
                                                    DB::rollBack();
                                                    return "userbontrans_failed";
                                                }
                                            } else {
                                                DB::rollBack();
                                                return "userbon_failed";
                                            }
                                        }

                                        $orderdetail_ids = [];
                                        //add all to orderdetails
                                        foreach ($sabad_info["product"] as $sabad_key => $sabad_val) {
                                            $sabad_info["product"][$sabad_key]["status"] = "در حال تحویل";
                                            $sabad_info["product"][$sabad_key]["final_count"] = $sabad_val["count"];
                                            $sabad_info["product"][$sabad_key]["tamin_count"] = 0;
                                            $sabad_info["product"][$sabad_key]["tamin_status"] = "در انتظار تامین";
                                            $sabad_info["product"][$sabad_key]["tamin_codes"]["active_codes"] = ["count" => 0];   // TODO: initialized with count=0  -- check by Dr.
                                            $sabad_info["product"][$sabad_key]["tamin_codes"]["cancel_codes"] = ["count" => 0];   // TODO: initialized with count=0  -- check by Dr.
                                            $orderdetail = new OrderDetail();
                                            $orderdetail->count = $sabad_val["count"];
                                            $orderdetail->status = "باز";
                                            $sabad_val["status"] = "باز";
                                            $orderdetail->price = $sabad_val["price"];
                                            $sabad_val["final_count"] = $sabad_val["count"];
                                            $orderdetail->total_price = $sabad_val["total_price"];
                                            $orderdetail->final_price = $sabad_val["final_price"];
                                            $orderdetail->product_name = $sabad_val["product_name"];
                                            $orderdetail->takhfif_total = $sabad_val["takhfif_price"];
                                            $orderdetail->takhfif_fee = $sabad_val["takhfif_fee"];
                                            $orderdetail->takhfif_estefade = $sabad_val["takhfif_estefade"];
                                            $orderdetail->takhfif_darsad = $sabad_val["takhfif_darsad"];
                                            $orderdetail->product_id = $sabad_val["product_id"];
                                            $orderdetail->order_id = $order->id;
                                            if ($orderdetail->save()) {
                                                $orderdetail_ids[] = $orderdetail->id;
                                                $sabad_info["product"][$sabad_key]["orderdetail_id"] = $orderdetail->id;
                                            }
                                        }
                                        if (count($orderdetail_ids) == count($sabad_info["product"])) {
                                            $sabad_info["info"]["p_order_id"] = $order->id;
                                            session()->put("card", json_encode($sabad_info));
//                                            $order->info = session()->get("card"); //
                                            $order->info = $info;
                                            $order->ordernumber = $order->id . $customer_id . time();   // generate unique code for ordernumber
                                            if ($order->save()) {
                                                session()->forget("card");
                                                DB::commit();
                                                return "success";
                                            } else {
                                                DB::rollBack();
                                                return "failed";
                                            }
                                        } else {
                                            DB::rollBack();
                                            return "orderdetail-failed";
                                        }
                                    } else {
                                        DB::rollBack();
                                        return "wallettrans-failed";
                                    }
                                } else {
                                    DB::rollBack();
                                    return "userwallet-failed";
                                }
                            } else {
                                DB::rollBack();
                                return "totalfinstrans-failed";
                            }
                        } else {
                            DB::rollBack();
                            return "totalfin-failed";
                        }
                    } else {
                        DB::rollBack();
                        return "orderfin-failed";
                    }
                } else {
                    DB::rollBack();
                    return "orderfins-failed";
                }
            } else {
                DB::rollBack();
                return "order-failed";
            }
        } else {
            return "sabad-failed";
        }
    }

    public function showCardIndexPage()
    {
        $array = ["userAddresses" => [], "zamanErsals" => [], "card" => null, "timeids" => [], "dargahs" => []];

        $user_id = Auth::id();
        $card_array = null;
        $times = [];
        // check if `card` key exists on session
        if (session()->has("card")) {
            $array["card"] = json_decode(session()->get("card"), true);
            $user_id = $array["card"]["info"]["user_id"] ?? Auth::id();

            foreach ($array["card"]["zaman_ersal"] as $key => $time) {
                if ($key != "count" && $key != "active_count") {
                    $times[] = intval($time["time_id"]);
                }
            }
        }
        $array["timeids"] = json_encode($times);

        $array["dargahs"] = PaymentGateway::where('is_active', 'Permission')->get();

        $array["userAddresses"] = !is_null($user_id) ? UserAddress::where("user_id", $user_id)->get() : null;

        return $array;
    }

    public function deleteCardSession()
    {
        if (session()->has("card")) {
            session()->forget("card");
            return "success";
        }
        return "notFound";
    }
}
