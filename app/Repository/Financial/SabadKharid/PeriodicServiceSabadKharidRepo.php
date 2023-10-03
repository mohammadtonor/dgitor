<?php

namespace App\Repository\Financial\SabadKharid;


use App\Models\Exchange\Exchange\Exchange\Exchange;
use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\Bon\UserBon;
use App\Models\Financial\Exchange\DetailFin\ExchangeDetailFin;
use App\Models\Financial\Exchange\DetailFinTrans\ExchangeDetailFinTrans;
use App\Models\Financial\PaymentGateway\PaymentGateway;
use App\Models\Financial\PeriodicService\DetailFin\PeriodicServiceDetailFin;
use App\Models\Financial\PeriodicService\DetailFinTrans\PeriodicServiceDetailFinTrans;
use App\Models\Financial\Purchase\DetailFin\PurchaseDetailFin;
use App\Models\Financial\Purchase\DetailFinTrans\PurchaseDetailFinTrans;
use App\Models\Financial\Purchase\Order\Order;
use App\Models\Financial\Purchase\Order\OrderDetail;
use App\Models\Financial\TotalFin\TotalFin;
use App\Models\Financial\TotalFinTrans\TotalFinTrans;
use App\Models\Financial\TransType\TransType;
use App\Models\Financial\Wallet\UserWallet;
use App\Models\Financial\Wallet\WalletTrans\UserWalletTrans;
use App\Models\PeriodicService\PeriodicService\PeriodicService;
use App\Models\Product\Product\Product;
use App\Models\User\Address\UserAddress;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeriodicServiceSabadKharidRepo
{


    private $cardFormat = [
        "product" => [
            // if type = '0' | user kharid karde
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
//            ]

        ],
        "periodic_service" => [
//            "****periodic_service_id-****user_id" => [
//                "type",
//                "title",
//                "description",
//                "start_date",
//                "end",
//                "periodic_count",
//                "periodic_time",
//                "how_long",
//                "product1_price",
//                "product2_price",
//                "mavotafavot",
//                "payer_mavotafavot",
//                "product1_id",
//                "product2_id",
//                "pre_product_id",
//                "user_id"
//            ],
        ],
        "exchange" => [
//            "****exchange_id-****produc_user_value_id" => [
//                "exchange_id",
//                "description",
//                "status_id",
//                "product1_id",
//                "product1_name",
//                "product1_price",
//                "product2_id",
//                "product2_name",
//                "product2_price",
//                "pre_product_id"
//                "periodic_service_id",
//                "mavotafavot",
//                "payer_mavotafavot",
//                "product1_karshenasi_hazine",
//                "product2_karshenasi_hazine",
//            ]
        ],
        "experting" => [
////            "****experting_id-****register_user_id"=>[

//            ]
        ],
        "info" => [
            "ps_count" => 0,
            "ps_total_price" => 0.00,
            "ps_final_price" => 0.00,

            "ps_pardakht_shode" => 0,
            "ps_pardakht_mande" => 0,

            "ps_sum_takhfif" => 0,

            "ps_periodic_service_id" => null,
            "ps_periodic_count" => 0,
            "ps_periodic_service_type" => null, // ---> kharid = '0' | exchnage = '1'

            "ps_exchange_id" => null,
            "ps_mavotafavot" => 0.00,
            "ps_payer_mavotafavot" => null,

            "ps_wallet" => 0,
            "ps_wallet_trans" => null,

            "ps_bon" => 0,
            "ps_bon_trans" => null,

            "ps_dargah" => 0.00,
            "ps_dargah_id" => null,

            "ps_pouse" => 0.00,
            "ps_pardakhti" => 0,
            "ps_naghdi" => 0,
            "ps_enteghal" => 0,

            "ps_moghaierat" => 0,
            "ps_esterdadvajh" => 0,
            "ps_esterdad_wallet" => 0,
            "ps_esterdad_card" => 0,

            "ps_bedehkar" => 0,
            "ps_bestankar" => 0,

            "ps_totalkharid" => 0,

            "user_id" => 0,
            "user_wallet" => 0,
            "user_bon" => 0,

            "ps_order_id" => 0,

//            'periodic_service' => [
//                "count" => 0,
//                "total_price" => 0.00,
//                "final_price" => 0.00,
//
//                "pardakht_shode" => 0,
//                "pardakht_mande" => 0,
//
//                "sum_takhfif" => 0,
//
//                "periodic_service_id" => null,
//                "periodic_count" => 0,
//                "periodic_service_type" => null, // ---> kharid = '0' | exchnage = '1'
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
//                "totalkharid" => 0,
//
//                "user_id" => 0,
//                "user_wallet" => 0,
//                "user_bon" => 0,
//
//                "order_id" => 0
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
    public function getPriceOfPeriodicService($product_id)
    {
        return Product::where("id", $product_id)->first()->price;
    }

    public function getTakhfifFee($product_id)
    {
        $takhfif_darsad = $this->getTakhfifPersentOfPeriodicService($product_id);
        $takhfif_price = $this->getTakhfifPriceOfPeriodicService($product_id);
        $kala_price = $this->getPriceOfPeriodicService($product_id);
        return ($takhfif_darsad == 0) ? $takhfif_price : ($kala_price * $takhfif_darsad) / 100;
    }

    public function getTakhfifPriceOfPeriodicService($product_id)
    {
        return Product::where("id", $product_id)->first()->discount_price;
    }

    public function getTakhfifPersentOfPeriodicService($product_id)
    {
        return Product::where("id", $product_id)->first()->discount_percentage;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //check exist product in card session
    public function checkExistPeriodicServiceInSession($periodic_service_id)
    {
        $card_array = json_decode(session()->get("card"));
        if (array_key_exists($card_array["periodic_service"], $card_array) && count($card_array["product"]) > 0) {
            foreach (array_keys($card_array["periodic_service"]) as $key) {
                if (ltrim(substr($key, 0, 6), "*") == $periodic_service_id) {
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
    public function addProductToCardSession($periodic_service_id, $register_user_id, $exchange_id = 0) //ok
    {
        if (!$this->checkExistCardSession())
            $this->createCardSession($register_user_id);

        $key = str_pad($periodic_service_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
        $card_array = json_decode(session()->get("card"), true);

        $periodic_service_id = PeriodicService::where("id", $periodic_service_id)->first()->id;

        $periodic_service = PeriodicService::where("id", $periodic_service_id)->first();

        if (!array_key_exists("periodic_service", $card_array))
            $card_array["periodic_service"] = [];

        $specPeriodicService_product1_price = $periodic_service->product1_price;
        $specPeriodicService_product2_price = $periodic_service->product2_price;

        $specPeriodicService_takhfif_fee = $this->getTakhfifFee($periodic_service->product1_id);
        $specPeriodicService_takhfif_estefade = $periodic_service->periodic_count * $specPeriodicService_takhfif_fee;
        $specPeriodicService_takhfif_price = $this->getTakhfifPriceOfPeriodicService($periodic_service->product1_id);
        $specPeriodicService_takhfif_darsad = $this->getTakhfifPersentOfPeriodicService($periodic_service->product1_id);

        if (!array_key_exists($key, $card_array["periodic_service"])) {

            $specPeriodicService_total_price = $specPeriodicService_product1_price;

            ///////////////////////////////////////////////////////

            $specPeriodicService = [];
            $specPeriodicService['type'] = $periodic_service->type;
            $specPeriodicService['title'] = $periodic_service->title;
            $specPeriodicService['description'] = $periodic_service->description;
            $specPeriodicService['start_time'] = $periodic_service->start_time;
            $specPeriodicService['product1_price'] = $periodic_service->product1_price;
            $specPeriodicService['periodic_count'] = $periodic_service->periodic_count;
            $specPeriodicService['periodic_time'] = $periodic_service->periodic_time;
            $specPeriodicService['how_long'] = $periodic_service->how_long;

            $card_array["info"]["ps_periodic_service_id"] = $periodic_service_id;
            $card_array["info"]["ps_periodic_service_count"] = $periodic_service->periodic_count;

            if ($periodic_service->type == '0') {
                // kharid product
                $card_array["info"]["ps_total_price"] += $specPeriodicService_total_price;
                $card_array["info"]["ps_final_price"] += ($specPeriodicService_total_price);
                $card_array["info"]["ps_pardakht_mande"] += ($specPeriodicService_total_price);
                $card_array["info"]["ps_bedehkar"] += ($specPeriodicService_total_price);
                $card_array["info"]["ps_sum_takhfif"] += $specPeriodicService_takhfif_estefade;
                $card_array["info"]["ps_totalkharid"] += ($specPeriodicService_total_price);

                $card_array["info"]["ps_periodic_service_type"] = "0";

                $specKala = [];
//                $specKala["count"] = $specKala_count;
                $specKala["price"] = $specPeriodicService_product1_price;
                $specKala["total_price"] = $specPeriodicService_total_price;
                $specKala["final_price"] = ($specPeriodicService_total_price);
                $specKala["product_name"] = $periodic_service->product1->title;
                $specKala["description"] = $periodic_service->product1->description;

                $specKala["takhfif_fee"] = $specPeriodicService_takhfif_fee;
                $specKala["takhfif_estefade"] = $specPeriodicService_takhfif_estefade;
                $specKala["takhfif_darsad"] = $specPeriodicService_takhfif_darsad;
                $specKala["takhfif_price"] = $specPeriodicService_takhfif_price;

                $specKala['product_id'] = $periodic_service->product1_id;
                $specKala["product_user_id"] = $periodic_service->product1->register_user_id;
                $specKala['register_user_id'] = $periodic_service->user_id;

                $card_array["product"][$key] = $specKala;

            } elseif ($periodic_service->type == '1') {
                // exchange
                // hint: Before the addPeriodicServiceToCardSession method is executed, the relevant record must be registered in the exchanges table
                $exchange = Exchange::where("id", $exchange_id)->first();

                $card_array["info"]["ps_total_price"] += $periodic_service->mavotafavot;
                $card_array["info"]["ps_final_price"] += $periodic_service->mavotafavot;
                $card_array["info"]["ps_pardakht_mande"] += $periodic_service->mavotafavot;
                $card_array["info"]["ps_bedehkar"] += $periodic_service->mavotafavot;
//                $card_array["info"]["sum_takhfif"] += $specExchange_takhfif_estefade;
                $card_array["info"]["ps_exchange_id"] += $exchange_id;
                $card_array["info"]["ps_mavotafavot"] += $periodic_service->mavotafavot;
                $card_array["info"]["ps_payer_mavotafavot"] = $periodic_service->payer_mavotafavot;

                $card_array["info"]["ps_periodic_service_type"] = "1";

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

                $card_array["exchange"][$key] = $specExchange;

            }

            $specPeriodicService['product1_id'] = $periodic_service->product1_id;
            $specPeriodicService['user_id'] = $periodic_service->user_id;

            $card_array["periodic_service"][$key] = $specPeriodicService;
            session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            return "success";
        } else {
            return "periodicService_isExists";
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
    public function deleteProdcutFromcard($product_service_id, $register_user_id = null) //ok
    {
        if (session()->has("card")) {
            $key = str_pad($product_service_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
            $card_array = json_decode(session()->get("card"), true);

            if (array_key_exists($key, $card_array["periodic_service"])) {
                if ($card_array["info"]["ps_periodic_service_type"] == '0') {
                    $specKala = $card_array["product"][$key];
                    $specKala_count = $specKala["count"];
                    $specKala_total_price = $specKala["total_price"];
                    $specKala_final_price = $specKala["final_price"];

                    $card_array["info"]["ps_count"] -= $specKala_count;
                    $card_array["info"]["ps_total_price"] -= $specKala_total_price;
                    $card_array["info"]["ps_final_price"] -= $specKala_final_price;
                    $card_array["info"]["ps_sum_takhfif"] -= $specKala["takhfif_estefade"];
                    unset($card_array["product"][$key]);
                } elseif ($card_array["info"]["ps_periodic_service_type"] == '1') {
                    $exchange = $card_array["exchange"][$key];
                    $exchange_total_price = $exchange["total_price"];
                    $exchange_final_price = $exchange["final_price"];
                    $exchange_pardakht_mande = $card_array["info"]["ps_pardakht_mande"];
                    $exchange_bedehkar = $card_array["info"]["ps_bedehkar"];
                    $exchange_mavotafavot = $card_array["info"]["ps_mavotafavot"];

                    $card_array["info"]["ps_total_price"] -= $exchange_total_price;
                    $card_array["info"]["ps_final_price"] -= $exchange_final_price;
                    $card_array["info"]["ps_pardakht_mande"] -= $exchange_pardakht_mande;
                    $card_array["info"]["ps_bedehkar"] -= $exchange_bedehkar;
                    $card_array["info"]["ps_mavotafavot"] -= $exchange_mavotafavot;
                    $card_array["info"]["ps_payer_mavotafavot"] = null;
                    $card_array["info"]["ps_exchange_id"] = null;
                    unset($card_array["exchange"][$key]);
                }
                $card_array["info"]["ps_periodic_service_id"] = null;
                $card_array["info"]["ps_periodic_service_count"] = 0;
                $card_array["info"]["ps_periodic_service_type"] = null;

                unset($card_array["periodic_service"][$key]);
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
                    if ($card_array["info"]["ps_pardakht_shode"] != $card_array["info"]["ps_final_price"] && $card_array["info"]["ps_pardakht_mande"] != 0) {
                        $card_array["info"]["user_wallet"] += (intval($card_array["info"]["ps_wallet"]) - intval($wallet)); // TODO: check by Dr.
                        $card_array["info"]["ps_wallet"] += intval($wallet);    // TODO: check by Dr.
                        $card_array["info"]["ps_pardakht_shode"] += $wallet;

                        if ($card_array["info"]["ps_bedehkar"] < $wallet) {
                            $card_array["info"]["ps_pardakht_mande"] -= 0;
                            $card_array["info"]["ps_bedehkar"] -= 0;
                            $card_array["info"]["ps_bestankar"] += $wallet - $card_array["info"]["ps_bedehkar"];
                        } else {
                            $card_array["info"]["ps_pardakht_mande"] -= $wallet;
                            $card_array["info"]["ps_bedehkar"] -= $wallet;
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
                    if ($card_array["info"]["ps_pardakht_shode"] != $card_array["info"]["ps_final_price"] && $card_array["info"]["ps_pardakht_mande"] != 0) {
                        $card_array["info"]["user_bon"] += (intval($card_array["info"]["ps_bon"]) - intval($bon)); // TODO: check by Dr.
                        $card_array["info"]["ps_bon"] += intval($bon);    // TODO: check by Dr.
                        $card_array["info"]["ps_pardakht_shode"] += $bon;

                        if ($card_array["info"]["ps_bedehkar"] < $bon) {
                            $card_array["info"]["ps_pardakht_mande"] -= 0;
                            $card_array["info"]["ps_bedehkar"] -= 0;
                            $card_array["info"]["ps_bestankar"] += $bon - $card_array["info"]["ps_bedehkar"];
                        } else {
                            $card_array["info"]["ps_pardakht_mande"] -= $bon;
                            $card_array["info"]["ps_bedehkar"] -= $bon;
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
            if ($card_array["info"]["ps_pardakht_shode"] != $card_array["info"]["ps_final_price"] && $card_array["info"]["ps_pardakht_mande"] != 0) {
                $card_array["info"]["ps_dargah"] = $dargah;   //TODO: check by Dr.
                $card_array["info"]["ps_dargah_id"] = $dargah_id;
                $card_array["info"]["ps_pardakht_shode"] += $dargah;

                if ($card_array["info"]["ps_bedehkar"] < $dargah) {
                    $card_array["info"]["ps_pardakht_mande"] = 0;
                    $card_array["info"]["ps_bedehkar"] = 0;
                    $card_array["info"]["ps_bestankar"] += $dargah - $card_array["info"]["ps_bedehkar"];
                } else {
                    $card_array["info"]["ps_pardakht_mande"] -= $dargah;
                    $card_array["info"]["ps_bedehkar"] -= $dargah;
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
    public function addSabadToTransactionAndDetailFine($dargah = 0, $dargah_id = null, $info = null)
    {
        if ($this->checkExistCardSession()) {
            $sabad_info = json_decode(session()->get("card"), true);

            $info = ($info == null) ? session()->get("card") : $info;

//            $count = $sabad_info["info"]["ps_count"];
//            $price = $sabad_info["product"]["ps_price"];
            $total_price = $sabad_info["info"]["ps_total_price"];
            $final_price = $sabad_info["info"]["ps_final_price"];
            $sum_takhfif = $sabad_info["info"]["ps_sum_takhfif"];

            $wallet = $sabad_info["info"]["ps_wallet"];
            $wallet_trans = $sabad_info["info"]["ps_wallet_trans"];

            $bon = $sabad_info["info"]["ps_bon"];
            $bon_trans = $sabad_info["info"]["ps_bon_trans"];

            $pdargah = $sabad_info["info"]["ps_dargah"];
            $pdargah_id = $sabad_info["info"]["ps_dargah_id"];

            $dargah = ($dargah == 0) ? $sabad_info["info"]["ps_dargah"] : $dargah;
            $dargah_id = ($dargah_id == null) ? $sabad_info["info"]["ps_dargah_id"] : $dargah_id;

            $pouse = $sabad_info["info"]["ps_pouse"];
            $pardakhti = $sabad_info["info"]["ps_pardakhti"];
            $naghdi = $sabad_info["info"]["ps_naghdi"];
            $enteghal = $sabad_info['info']['ps_enteghal'];

            $bedehkar = $sabad_info['info']["ps_bedehkar"];
            $bestankar = $sabad_info['info']["ps_bestankar"];

            $moghaierat = $sabad_info["info"]["ps_moghaierat"];
            $esterdadvajh = $sabad_info["info"]["ps_esterdadvajh"];
            $esterdad_wallet = $sabad_info["info"]["ps_esterdad_wallet"];
            $esterdad_card = $sabad_info["info"]["ps_esterdad_card"];

            $totalkharid = $sabad_info["info"]["ps_totalkharid"];

            $customer_id = $sabad_info["info"]["user_id"] ?? 1;

//            $ersaltimes = $sabad_info["zaman_ersal"]; // todo: later
//            $peik = $sabad_info["peik"]; // todo: later
//            $addrs = $sabad_info["addrs"]; // todo: later

            $exchange_id = $sabad_info["info"]["ps_exchange_id"];
            $mavotafavot = $sabad_info["info"]["ps_mavotafavot"];
            $payer_mavotafavot = $sabad_info["info"]["ps_payer_mavotafavot"];

            $periodic_service_id = $sabad_info["info"]["ps_periodic_service_id"];
            $periodic_service_count = $sabad_info["info"]["ps_periodic_service_count"];
            $periodic_service_type = $sabad_info["info"]["ps_periodic_service_type"];

            DB::beginTransaction();

            //add periodicServiceDetailFins
            $periodicServiceDetailFins = new PeriodicServiceDetailFin();
//            $periodicServiceDetailFins->price = $price;
            $periodicServiceDetailFins->periodic_count = $periodic_service_count;
            $periodicServiceDetailFins->total_price = $total_price;
            $periodicServiceDetailFins->final_price = $final_price;
            $periodicServiceDetailFins->mavotafavot = $mavotafavot;
            $periodicServiceDetailFins->esterdadvajh = $esterdadvajh;
            $periodicServiceDetailFins->naghdi = $naghdi;
            $periodicServiceDetailFins->enteghal = $enteghal;
            $periodicServiceDetailFins->pouse = $pouse;
            $periodicServiceDetailFins->dargah = $dargah;
            $periodicServiceDetailFins->wallet = $wallet;
            $periodicServiceDetailFins->wallet_trans = $wallet_trans;
            $periodicServiceDetailFins->bon = $bon;
            $periodicServiceDetailFins->bon_trans = $bon_trans;
            $periodicServiceDetailFins->totalkharid = $totalkharid;
            $periodicServiceDetailFins->bestankar = $bestankar;
            $periodicServiceDetailFins->bedehkar = $bedehkar;
            $periodicServiceDetailFins->periodic_service_id = $periodic_service_id;

            if ($periodicServiceDetailFins->save()) {
                // add periodicServiceDetailFinTrans;
                $periodicServiceDetailFinsTrans = new PeriodicServiceDetailFinTrans();
                $periodicServiceDetailFinsTrans->info = $info;
//                $periodicServiceDetailFinsTrans->price = $price;
                $periodicServiceDetailFinsTrans->periodic_count = $periodic_service_count;
                $periodicServiceDetailFinsTrans->total_price = $total_price;
                $periodicServiceDetailFinsTrans->final_price = $final_price;
                $periodicServiceDetailFinsTrans->mavotafavot = $mavotafavot;
                $periodicServiceDetailFinsTrans->enteghal = $enteghal;
                $periodicServiceDetailFinsTrans->wallet = $wallet;
                $periodicServiceDetailFinsTrans->dargah = $dargah;
                $periodicServiceDetailFinsTrans->bon = $bon;
                $periodicServiceDetailFinsTrans->pouse = $pouse;
                $periodicServiceDetailFinsTrans->naghdi = $naghdi;
                $periodicServiceDetailFinsTrans->sum_takhfif = $sum_takhfif;
                $periodicServiceDetailFinsTrans->moghaierat = $moghaierat;
                $periodicServiceDetailFinsTrans->esterdad_wallet = $esterdad_wallet;
                $periodicServiceDetailFinsTrans->esterdad_card = $esterdad_card;
                $periodicServiceDetailFinsTrans->detailfin_id = $periodicServiceDetailFins->id;
                $periodicServiceDetailFinsTrans->transtype_id = 1; // todo: check with Dr.
                $periodicServiceDetailFinsTrans->gateway_id = $dargah_id;
                if ($periodicServiceDetailFinsTrans->save()) {
                    if ($periodic_service_type == '0') {
                        //create order
                        $order = new Order();
                        $order->status_id = Order::ORDER_OPEN;
//                        $order->rezerv = $rezerv;
                        $order->info = $info;
                        $order->user_id = $customer_id;
                        if ($order->save()) {
                            //create orderFins for order
                            $orderFins = new PurchaseDetailFin();
//                            $orderFins->count = $count;
//                            $orderFins->price = $price;
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
//                                $orderFinsTrans->count = $count;
//                                $orderFinsTrans->price = $price;
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
//                                        $totalFinsTrans->product_count = $count;
//                                        $totalFinsTrans->product_price = $price;
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
                    } elseif ($periodic_service_type == '1') {
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
                } else {
                    DB::rollBack();
                    return "periodicServiceDetailFinsTrans_failed";
                }
            } else {
                DB::rollBack();
                return "periodicServiceDetailFins_failed";
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
