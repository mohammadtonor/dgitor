<?php

namespace App\Repository\Financial\SabadKharid;


use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\Bon\UserBon;
use App\Models\Financial\Exchange\DetailFin\ExchangeDetailFin;
use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\TotalFin\TotalFin;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\Wallet\UserWallet;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use App\Models\Product\Product\Product;
use App\Models\User\Address\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExchangeSabadKharidRepo
{


    private $cardFormat = [
        "exchange" => [
//            "****product_user_id-****produc_user_value_id"=>[
//                "exchange_id",
//                "description",
//                "status_id",
//                "product1_id",
//                "product1_name",
//                "product1_price",
//                "product2_id",
//                "product2_name",
//                "product2_price",
//                "mavotafavot",
//                "payer_mavotafavot",
//            ]
        ],
        "product" => [
////            "****product_user_id-****produc_user_value_id"=>[

//            ]

        ],
        "periodic_service" => [
////            "****product_user_id-****produc_user_value_id"=>[

//            ]

        ],
        "experting" => [
////            "****product_user_id-****produc_user_value_id"=>[

//            ]

        ],
        "info" => [
            "e_total_price" => 0.00,
            "e_final_price" => 0.00,

            "e_pardakht_shode" => 0,
            "e_pardakht_mande" => 0,

            "e_sum_takhfif" => 0,

            "e_exchange_id" => null,
            "e_mavotafavot" => 0.00,
            "e_payer_mavotafavot" => null,

            "e_wallet" => 0,
            "e_wallet_trans" => null,

            "e_bon" => 0,
            "e_bon_trans" => null,

            "e_dargah" => 0.00,
            "e_dargah_id" => null,

            "e_pouse" => 0.00,
            "e_pardakhti" => 0,
            "e_naghdi" => 0,
            "e_enteghal" => 0,

            "e_moghaierat" => 0,
            "e_esterdadvajh" => 0,
            "e_esterdad_wallet" => 0,
            "e_esterdad_card" => 0,

            "e_bedehkar" => 0,
            "e_bestankar" => 0,

            "user_id" => 0,
            "user_wallet" => 0,
            "user_bon" => 0,

//            "exchange" => [
//                "total_price" => 0.00,
//                "final_price" => 0.00,
//
//                "pardakht_shode" => 0,
//                "pardakht_mande" => 0,
//
//                "sum_takhfif" => 0,
//
//                "exchange_id" => null,
//                "mavotafavot" => 0.00,
//                "payer_mavotafavot" => null,
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
//                "moghaierat" => 0,
//                "esterdadvajh" => 0,
//                "esterdad_wallet" => 0,
//                "esterdad_card" => 0,
//
//                "bedehkar" => 0,
//                "bestankar" => 0,
//
//                "user_id" => 0,
//                "user_wallet" => 0,
//                "user_bon" => 0,
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
    public function getPriceOfProduct($product_id)
    {
        return Product::where("id", $product_id)->first()->price;
    }

    public function getTakhfifFee($product_id)
    {
        $takhfif_darsad = $this->getTakhfifpersentOfProduct($product_id);
        $takhfif_price = $this->getTakhfifPriceOfProduct($product_id);
        $kala_price = $this->getPriceOfProduct($product_id);
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
    public function checkExistExchangeInSession($exchange_id)
    {
        $card_array = json_decode(session()->get("card"));
        if (array_key_exists($card_array["exchange"], $card_array) && count($card_array["exchange"]) > 0) {
            foreach (array_keys($card_array["exchange"]) as $key) {
                if (ltrim(substr($key, 0, 6), "*") == $exchange_id) {
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

    public function addExchangeToCardSession($exchange_id, $register_user_id) //ok
    {
        if (!$this->checkExistCardSession())
            $this->createCardSession($register_user_id);

        $key = str_pad($exchange_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
        $card_array = json_decode(session()->get("card"), true);

        $exchange_id = Exchange::where("id", $exchange_id)->first()->id;
        $exchange = Exchange::where("id", $exchange_id)->first();

        $product1_price = $this->getPriceOfProduct($exchange->product1_id);
        $product2_price = $this->getPriceOfProduct($exchange->product2_id);

//        $specExchange_product1_takhfif_estefade = $this->getTakhfifFee($exchange->product1_id);
//        $specExchange_product2_takhfif_estefade = $this->getTakhfifFee($exchange->product2_id);

        if (!array_key_exists("exchange", $card_array))
            $card_array["exchange"] = [];

        if (!array_key_exists($key, $card_array["exchange"])) {
            $card_array["info"]["e_total_price"] += $exchange->mavotafavot;
            $card_array["info"]["e_final_price"] += $exchange->mavotafavot;
            $card_array["info"]["e_pardakht_mande"] += $exchange->mavotafavot;
            $card_array["info"]["e_bedehkar"] += $exchange->mavotafavot;
//            $card_array["info"]["sum_takhfif"] += $specExchange_takhfif_estefade;
            $card_array["info"]["e_exchange_id"] += $exchange_id;
            $card_array["info"]["e_mavotafavot"] += $exchange->mavotafavot;
            $card_array["info"]["e_payer_mavotafavot"] = $exchange->payer_mavotafavot;

            $specExchange = [];
            $specExchange["exchange_id"] = $exchange_id;
            $specExchange["description"] = $exchange->description;
            $specExchange["status_id"] = $exchange->status_id;
            $specExchange["product1_id"] = $exchange->product1_id;
            $specExchange["product1_name"] = $exchange->product1->title;
            $specExchange["product1_price"] = $exchange->product1_price;
            $specExchange["product2_id"] = $exchange->product2_id;
            $specExchange["product2_name"] = $exchange->product2->title;
            $specExchange["product2_price"] = $exchange->product2_price;
            $specExchange["mavotafavot"] = $exchange->mavotafavot;
            $specExchange["payer_mavotafavot"] = $exchange->payer_mavotafavot;

            //////////////////////////////////////////////////////////////////////

            $card_array["exchange"][$key] = $specExchange;

            session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            return "success";
        } else {
            return "exchange_isExists";
        }
    }

    //increase product count
    public function incProductInSabad($product_id, $register_user_id, $count) //ok
    {
    }

    //decrease product count
    public function decProductFromSabad($product_id, $register_user_id, $count) //ok
    {

    }

    //delete product from sabad
    public function deleteExchangeFromcard($exchange_id, $register_user_id = null) //ok
    {
        if (session()->has("card")) {
            $key = str_pad($exchange_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
            $card_array = json_decode(session()->get("card"), true);

            if (array_key_exists($key, $card_array["exchange"])) {
                $exchange = $card_array["exchange"][$key];
                $exchange_total_price = $exchange["total_price"];
                $exchange_final_price = $exchange["final_price"];
                $exchange_pardakht_mande = $card_array["info"]["e_pardakht_mande"];
                $exchange_bedehkar = $card_array["info"]["e_bedehkar"];
                $exchange_mavotafavot = $card_array["info"]["e_mavotafavot"];

                $card_array["info"]["e_total_price"] -= $exchange_total_price;
                $card_array["info"]["e_final_price"] -= $exchange_final_price;
                $card_array["info"]["e_pardakht_mande"] -= $exchange_pardakht_mande;
                $card_array["info"]["e_bedehkar"] -= $exchange_bedehkar;
                $card_array["info"]["e_mavotafavot"] -= $exchange_mavotafavot;
                $card_array["info"]["e_payer_mavotafavot"] = null;
                $card_array["info"]["e_exchange_id"] = null;
                unset($card_array["exchange"][$key]);
                //////////////////////////////////////////////////////////////////////
                session()->put("card", json_encode($card_array));
                return "success";
            }
            return "failed";
        }
        return "failed";
    }

    // todo: later
    public function addErsalTimeToSabad($date, $ersalTime_ids, $exactTime)  //ersalTime=[time_id ,day,from,to]
    {
        //TODO: check by Dr.
        // if cart-session does not exist, then create it
        $user_id = Auth::id() ?? 1; // TODO: modify it
        $karsehans_id = 0; // TODO: modify it
        if (!$this->checkExistCardSession())
            $this->createCardSession($user_id, $karsehans_id);

        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
            $count = $card_array["zaman_ersal"]["count"];

            foreach ($ersalTime_ids as $ersalTime_id) {
//                $time=dsdsd;//todo

                //TODO: check by Dr.
//                if(!Companydeliverytime::where('id', $ersalTime_id)->exists()){
//                    continue;
//                }

//                $time = Companydeliverytime::where('id', $ersalTime_id)->first();
                $time = "2023-07-31 10:47:31";
                $card_array["zaman_ersal"]["time" . ($count + 1)] = [
                    "time_id" => $ersalTime_id,
                    "date" => jdate($date)->format('%A, %d %B %y'),

                    "dayofweek" => $time->dayname,
                    "timefrom" => $time->starttime,
                    "timeto" => $time->endtime,
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

    // todo: later
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
                    if ($card_array["info"]["e_pardakht_shode"] != $card_array["info"]["e_final_price"] && $card_array["info"]["e_pardakht_mande"] != 0) {
                        $card_array["info"]["user_wallet"] += (intval($card_array["info"]["e_wallet"]) - intval($wallet)); // TODO: check by Dr.
                        $card_array["info"]["e_wallet"] += intval($wallet);    // TODO: check by Dr.
                        $card_array["info"]["e_pardakht_shode"] += $wallet;

                        if ($card_array["info"]["e_bedehkar"] < $wallet) {
                            $card_array["info"]["e_pardakht_mande"] -= 0;
                            $card_array["info"]["e_bedehkar"] -= 0;
                            $card_array["info"]["e_bestankar"] += $wallet - $card_array["info"]["e_bedehkar"];
                        } else {
                            $card_array["info"]["e_pardakht_mande"] -= $wallet;
                            $card_array["info"]["e_bedehkar"] -= $wallet;
                        }

                        session()->put("card", json_encode($card_array));
                        return "success";
                    } else {
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
                    if ($card_array["info"]["e_pardakht_shode"] != $card_array["info"]["e_final_price"] && $card_array["info"]["e_pardakht_mande"] != 0) {
                        $card_array["info"]["user_bon"] += (intval($card_array["info"]["e_bon"]) - intval($bon)); // TODO: check by Dr.
                        $card_array["info"]["e_bon"] += intval($bon);    // TODO: check by Dr.
                        $card_array["info"]["e_pardakht_shode"] += $bon;

                        if ($card_array["info"]["e_bedehkar"] < $bon) {
                            $card_array["info"]["e_pardakht_mande"] -= 0;
                            $card_array["info"]["e_bedehkar"] -= 0;
                            $card_array["info"]["e_bestankar"] += $bon - $card_array["info"]["e_bedehkar"];
                        } else {
                            $card_array["info"]["e_pardakht_mande"] -= $bon;
                            $card_array["info"]["e_bedehkar"] -= $bon;
                        }

                        session()->put("card", json_encode($card_array));
                        return "success";
                    } else {
                        return "pardakht_shode";
                    }
                } else {
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
            if ($card_array["info"]["e_pardakht_shode"] != $card_array["info"]["e_final_price"] && $card_array["info"]["e_pardakht_mande"] != 0) {
                $card_array["info"]["e_dargah"] = $dargah;   //TODO: check by Dr.
                $card_array["info"]["e_dargah_id"] = $dargah_id;
                $card_array["info"]["e_pardakht_shode"] += $dargah;

                if ($card_array["info"]["e_bedehkar"] < $dargah) {
                    $card_array["info"]["e_pardakht_mande"] = 0;
                    $card_array["info"]["e_bedehkar"] = 0;
                    $card_array["info"]["e_bestankar"] += $dargah - $card_array["info"]["bedehkar"];
                } else {
                    $card_array["info"]["e_pardakht_mande"] -= $dargah;
                    $card_array["info"]["e_bedehkar"] -= $dargah;
                }

                session()->put("card", json_encode($card_array));
                return "success";
            } else {
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

//            $count = $sabad_info["info"]["e_count"];
//            $price = $sabad_info["product"]["price"];
//            $total_price = $sabad_info["info"]["e_total_price"];
//            $final_price = $sabad_info["info"]["e_final_price"];

//            $sum_takhfif = $sabad_info["info"]["e_sum_takhfif"];

            $wallet = $sabad_info["info"]["e_wallet"];
            $wallet_trans = $sabad_info["info"]["e_wallet_trans"];

            $bon = $sabad_info["info"]["e_bon"];
            $bon_trans = $sabad_info["info"]["e_bon_trans"];

            $pdargah = $sabad_info["info"]["e_dargah"];
            $pdargah_id = $sabad_info["info"]["e_dargah_id"];

            $dargah = ($dargah == 0) ? $sabad_info["info"]["e_dargah"] : $dargah;
            $dargah_id = ($dargah_id == null) ? $sabad_info["info"]["e_dargah_id"] : $dargah_id;

            $pouse = $sabad_info["info"]["e_pouse"];
            $pardakhti = $sabad_info["info"]["e_pardakhti"];
            $naghdi = $sabad_info["info"]["e_naghdi"];
            $enteghal = $sabad_info['info']['e_enteghal'];

            $bedehkar = $sabad_info['info']["e_bedehkar"];
            $bestankar = $sabad_info['info']["e_bestankar"];

            $moghaierat = $sabad_info["info"]["e_moghaierat"];
            $esterdadvajh = $sabad_info["info"]["e_esterdadvajh"];
            $esterdad_wallet = $sabad_info["info"]["e_esterdad_wallet"];
            $esterdad_card = $sabad_info["info"]["e_esterdad_card"];

            $customer_id = $sabad_info["info"]["user_id"] ?? 1;

//            $ersaltimes = $sabad_info["zaman_ersal"]; // todo: later
//            $peik = $sabad_info["peik"]; // todo: later
//            $addrs = $sabad_info["addrs"]; // todo: later

            $exchange_id = $sabad_info["info"]["e_exchange_id"];
            $mavotafavot = $sabad_info["info"]["e_mavotafavot"];
            $payer_mavotafavot = $sabad_info["info"]["e_payer_mavotafavot"];

            DB::beginTransaction();

            // add exchangeDetailFin
            $exchangeDetailFins = new ExchangeDetailFin();
            if ($payer_mavotafavot == '1') {
                $exchangeDetailFins->side1_mavotafavot = $mavotafavot;
                $exchangeDetailFins->side1_esterdadvajh = $esterdadvajh;
                $exchangeDetailFins->side1_naghdi = $naghdi;
                $exchangeDetailFins->side1_pouse = $pouse;
                $exchangeDetailFins->side1_enteghal = $enteghal;
                $exchangeDetailFins->side1_dargah = $dargah;
                $exchangeDetailFins->side1_wallet = $wallet;
                $exchangeDetailFins->side1_wallet_trans = $wallet_trans;
                $exchangeDetailFins->side1_bon = $bon;
                $exchangeDetailFins->side1_bon_trans = $bon_trans;
                $exchangeDetailFins->side1_bestankar = $bestankar;
                $exchangeDetailFins->side1_bedehkar = $bedehkar;
            } elseif ($payer_mavotafavot == '2') {
                $exchangeDetailFins->side2_mavotafavot = $mavotafavot;
                $exchangeDetailFins->side2_esterdadvajh = $esterdadvajh;
                $exchangeDetailFins->side2_naghdi = $naghdi;
                $exchangeDetailFins->side2_pouse = $pouse;
                $exchangeDetailFins->side2_enteghal = $enteghal;
                $exchangeDetailFins->side2_dargah = $dargah;
                $exchangeDetailFins->side2_wallet = $wallet;
                $exchangeDetailFins->side2_wallet_trans = $wallet_trans;
                $exchangeDetailFins->side2_bon = $bon;
                $exchangeDetailFins->side2_bon_trans = $bon_trans;
                $exchangeDetailFins->side2_bestankar = $bestankar;
                $exchangeDetailFins->side2_bedehkar = $bedehkar;
            }
            $exchangeDetailFins->exchange_id = $exchange_id;

            if ($exchangeDetailFins->save()) {
                // add ExchangeDetailFinTrans
                $exchangeDetailFinTrans = new ExchangeDetailFinTrans();
                $exchangeDetailFinTrans->info = $info;
                if ($payer_mavotafavot == '1') {
                    $exchangeDetailFinTrans->side1_mavotafavot = $mavotafavot;
                    $exchangeDetailFinTrans->side1_wallet = $wallet;
                    $exchangeDetailFinTrans->side1_bon = $bon;
                    $exchangeDetailFinTrans->side1_dargah = $dargah;
                    $exchangeDetailFinTrans->side1_naghdi = $naghdi;
                    $exchangeDetailFinTrans->side1_pouse = $pouse;
                    $exchangeDetailFinTrans->side1_moghaierat = 0;
                    $exchangeDetailFinTrans->side1_esterdad_wallet = $esterdad_wallet;
                    $exchangeDetailFinTrans->side1_esterdad_card = $esterdad_card;
                } elseif ($payer_mavotafavot == '2') {
                    $exchangeDetailFinTrans->side2_mavotafavot = $mavotafavot;
                    $exchangeDetailFinTrans->side2_wallet = $wallet;
                    $exchangeDetailFinTrans->side2_bon = $bon;
                    $exchangeDetailFinTrans->side2_dargah = $dargah;
                    $exchangeDetailFinTrans->side2_naghdi = $naghdi;
                    $exchangeDetailFinTrans->side2_pouse = $pouse;
                    $exchangeDetailFinTrans->side2_moghaierat = 0;
                    $exchangeDetailFinTrans->side2_esterdad_wallet = $esterdad_wallet;
                    $exchangeDetailFinTrans->side2_esterdad_card = $esterdad_card;
                }
                $exchangeDetailFinTrans->detailfin_id = $exchangeDetailFins->id;
                $exchangeDetailFinTrans->transtype_id = 2; // todo : check with Dr.
                $exchangeDetailFinTrans->gateway_id = $dargah_id;
                if ($exchangeDetailFinTrans->save()){
                    // change totalFin
                    $totalFins = TotalFin::where("user_id", $customer_id)->first();
                    $totalFins->total_exchange += $mavotafavot; // todo: check
                    $totalFins->etebar_naghdi_estefade += $naghdi;
                    $totalFins->mojodi_wallet -= $wallet;
                    $totalFins->mojodi_bon -= $bon;
                    $totalFins->sum_etebar_wallet_estefade += $wallet;
                    $totalFins->sum_etebar_bon_estefade += $bon;
                    $totalFins->sum_trans_dargah += $dargah;
                    $totalFins->sum_esterdad += $esterdadvajh;
                    $totalFins->sum_pouse += $pouse;
                    $totalFins->pardakhti += ($wallet + $bon + $dargah + $naghdi); // todo : check with Dr.
                    if ($totalFins->save()){
                        // add totalFinTrans
                        $totalFinTrans = new TotalFinTrans();
                        $totalFinTrans->info =  $info;
                        $totalFinTrans->exchange_mavotafavot = $mavotafavot;
                        $totalFinTrans->wallet = $wallet;
                        $totalFinTrans->bon = $bon;
                        $totalFinTrans->dargah = $dargah;
                        $totalFinTrans->naghdi = $naghdi;
                        $totalFinTrans->enteghal = $enteghal;
                        $totalFinTrans->pouse = $pouse;
                        $totalFinTrans->bestankar = $bestankar;
                        $totalFinTrans->bedehkar = $bedehkar;
                        $totalFinTrans->moghaierat = 0;
                        $totalFinTrans->esterdad_wallet = 0;
                        $totalFinTrans->esterdad_card = 0;
                        $totalFinTrans->exchange_detailfins_tran_id = $exchangeDetailFinTrans->id;
                        $totalFinTrans->totalfins_id = $totalFins->id;
                        if ($totalFinTrans->save()){
                            // change userWallet
                            $userWallet = UserWallet::where("user_id", $customer_id)->first();
                            $wallet_first_mojodi = $userWallet->mojodi;
                            $userWallet->mojodi -= $wallet;
                            if ($userWallet->save()){
                                // add walletTrans
                                $walletTrans = new UserWalletTrans();
                                $walletTrans->info =  $info;
                                $walletTrans->price = $wallet;
                                $walletTrans->status = 'bardasht';
                                $walletTrans->firstmojodi = $wallet_first_mojodi;
                                $walletTrans->lastmojodi = ($wallet_first_mojodi - $wallet);
                                $walletTrans->moghaierat = 0;
                                $walletTrans->exchange_detailfins_tran_id = $exchangeDetailFinTrans->id;
                                $walletTrans->user_wallet_id = $userWallet->id;
                                if ($walletTrans->save()){
                                    if (UserBon::where("user_id", $customer_id)->exists()){
                                        $userBon = UserBon::where("user_id", $customer_id)->first();
                                        $bon_first_mojodi = $userBon->cost;
                                        $userBon->cost -= $bon;
                                        if ($userBon->save()) {
                                            // add bon transaction
                                            $bonTrans = new UserBonTrans();
                                            $bonTrans->info =  $info;
                                            $bonTrans->price = $bon;
                                            $bonTrans->status = "bardasht";
                                            $bonTrans->firstmojodi = $bon_first_mojodi;
                                            $bonTrans->lastmojodi = ($bon_first_mojodi - $bon);
                                            $bonTrans->moghaierat = 0;
                                            $bonTrans->exchange_detailfins_tran_id = $exchangeDetailFinTrans->id;
                                            $bonTrans->user_bon_id = $userBon->id;
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
                                    session()->forget("card");
                                    DB::commit();
                                    return "success";
                                }else{
                                    DB::rollBack();
                                    return "userWalletTrans_failed";
                                }
                            }else{
                                DB::rollBack();
                                return "userWallet_failed";
                            }
                        }else{
                            DB::rollBack();
                            return "totalFinTrans_failed";
                        }
                    }else{
                        DB::rollBack();
                        return "totalFins_failed";
                    }
                }else{
                    DB::rollBack();
                    return "exchangeDetailFinTrans_failed";
                }
            } else {
                DB::rollBack();
                return "exchangeDetailFins_failed";
            }
        }
        return "sabad-failed";
    }

    public function showCardIndexPage()
    {
        $array = ["userAddresses" => [], "zamanErsals" => [], "card" => null, "timeids" => [], "dargahs" => []];

        $user_id = Auth::id() ?? 1;
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

        $array["dargahs"] = PaymentGateway::where('is_active', '1')->get();

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
