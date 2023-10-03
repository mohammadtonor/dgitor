<?php

namespace App\Repository\Financial\SabadKharid;


use App\Models\Experting\Experting\Experting;
use App\Models\Financial\Bon\BonTrans\UserBonTrans;
use App\Models\Financial\Bon\UserBon;
use App\Models\Financial\Experting\DetailFin\ExpertingDetailFin;
use App\Models\Financial\Experting\DetailFinTrans\ExpertingDetailFinTrans;
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

class ExpertingSabadKharidRepo
{

    private $cardFormat = [
        "experting" => [
//            "****exr_experting_id-****register_user_id" => [
//                "exr_experting_id" => null,
//                "title" => "",
//                "product_id" => null,
//                "register_user_id" => null,
//                "estimate_Price" => 0.00,
//                "karshenasi_hazine" => 0.00,
//            ]

        ],
        "product" => [
////            "****product_id-****register_user_id"=>[

//            ]

        ],
        "periodic_service" => [
////            "****periodic_service_id-****register_user_id"=>[

//            ]

        ],
        "exchange" => [
////            "****exchange_id-****register_user_id"=>[

//            ]

        ],
        "info" => [
            "exr_total_price" => 0.00,
            "exr_final_price" => 0.00,

            "exr_pardakht_shode" => 0,
            "exr_pardakht_mande" => 0,

            "exr_sum_takhfif" => 0,

            "exr_experting_id" => null,
            "karshenasi_hazine" => null,

            "exr_wallet" => 0,
            "exr_wallet_trans" => null,

            "exr_bon" => 0,
            "exr_bon_trans" => null,

            "exr_dargah" => 0.00,
            "exr_dargah_id" => null,

            "exr_pouse" => 0.00,
            "exr_pardakhti" => 0,
            "exr_naghdi" => 0,
            "exr_enteghal" => 0,

            "exr_moghaierat" => 0,
            "exr_esterdadvajh" => 0,
            "exr_esterdad_wallet" => 0,
            "exr_esterdad_card" => 0,

            "exr_bedehkar" => 0,
            "exr_bestankar" => 0,

            "exr_totalkharid" => 0,

            "user_id" => 0,
            "exr_user_wallet" => 0,
            "exr_user_bon" => 0,
        ],

//        "addrs" => ["count" => 0, "active_count" => 0],
//        "zaman_ersal" => ["count" => 0, "active_count" => 0],
//        "esterdad" => ["count" => 0, "active_count" => 0]
    ];

    //check exist session for sabad
    public function checkExistCardSession()
    {
        return session()->has("card");
    }

    //create session card
    public function createCardSession($user_id = null, $karshenas_id = 0)
    {
        $this->cardFormat["info"]["user_id"] = $user_id;
        $this->cardFormat["info"]["exr_user_wallet"] = !is_null($user_id) ? UserWallet::where("user_id", $user_id)->first()->mojodi : null;
        $this->cardFormat["info"]["exr_user_bon"] = !is_null($user_id) ? UserBon::where("user_id", $user_id)->first()->cost : null;
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


    public function getTakhfifFee($product_id, $product_user_value_id)
    {

    }

    public function getTakhfifPriceOfProduct($product_id, $product_user_value_id)
    {

    }

    public function getTakhfifpersentOfProduct($product_id)
    {

    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //check exist product in card session
    public function checkExistExpertingInSession($expert_id)
    {
        $card_array = (array)json_decode(session()->get("card"));
        if (array_key_exists("experting", $card_array) && count((array)$card_array["experting"]) > 0) {
            foreach (array_keys((array)$card_array["experting"]) as $key) {
                if (ltrim(substr($key, 0, 5), "*") == $expert_id) {
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

//    public function addProductToCardSession($product_id,$count,$register_user_id=null,$user_id=1,$karsehans_id=0,$is_hozoori="0",$is_userleveltakhfif=null,$userlevel_name=null,$userlevel_takhfif_price=null,$userlevel_darsad=null) //ok
    public function addExpertingToCardSession($experting_id, $register_user_id = null, $user_id = 1, $karshenasi_hazine = 0) //ok
    {
        if (!$this->checkExistCardSession())
            $this->createCardSession($register_user_id, $experting_id);

        $key = str_pad($experting_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
        $card_array = (array)json_decode(session()->get("card"), true);

        $experting = Experting::where("id", $experting_id)->first();
        //get-experting-cost
        $karshenasi_hazine = Experting::where("id", $experting_id)->first()->cost;

        if (!array_key_exists("experting", (array)$card_array))
            $card_array["experting"] = [];

        if (!array_key_exists($key, $card_array["experting"])) {

            $card_array["info"]["exr_experting_id"] = $experting->id;
            $card_array["info"]["karshenasi_hazine"] = $karshenasi_hazine;
            $card_array["info"]["exr_total_price"] += $karshenasi_hazine;
            $card_array["info"]["exr_pardakht_mande"] += $karshenasi_hazine;
            $card_array["info"]["exr_bedehkar"] += $karshenasi_hazine;
//            $card_array["info"]["sum_takhfif"] += $specExchange_takhfif_estefade;

            $specExperting = [];
            $specExperting["experting_id"] = $experting->id;
            $specExperting["title"] = $experting->title;
            $specExperting["product_id"] = $experting->product_id;
            $specExperting["register_user_id"] = $experting->register_user_id;
            $specExperting["cost"] = $experting->cost;
            //$specExperting["private_experting_id"] = $experting->private_experting_id;
            //$specExperting["public_experting_id"] = $experting->private_experting_id;
            //////////////////////////////////////////////////////////////////////

            $card_array["experting"][$key] = $specExperting;

            session()->put("card", json_encode($card_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

        } else {

            return "experting-exists";
        }
        return "success";
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
    public function deleteExpertingFromcard($expert_id, $register_user_id = null) //ok
    {
        if (session()->has("card")) {
            $key = str_pad($expert_id, 5, "*", STR_PAD_LEFT) . "-" . str_pad($register_user_id, 5, "*", STR_PAD_LEFT);
            $card_array = json_decode(session()->get("card"), true);
            if (array_key_exists($key, $card_array["experting"])) {
                $experting = $card_array["experting"][$key];
                $experting_bedehkar = $card_array["info"]["exr_bedehkar"];
                $experting_karshenasi_hazineh = $experting["cost"];

                $card_array["info"]["exr_total_price"] -= $experting_karshenasi_hazineh;
                $card_array["info"]["exr_final_price"] -= $experting_karshenasi_hazineh;
                $card_array["info"]["exr_pardakht_mande"] -= $experting_karshenasi_hazineh;
                $card_array["info"]["exr_bedehkar"] -= $experting_bedehkar;
                $card_array["info"]["exr_experting_id"] = null;
                $card_array["info"]["karshenasi_hazine"] = 0.00;

                unset($card_array["experting"][$key]);
                //////////////////////////////////////////////////////////////////////
                session()->put("card", json_encode($card_array));
                return "success";
            }
            return "failed";
        }
        return "failed";
    }


    public function addErsalTimeToSabad($date, $ersalTime_ids, $exactTime)  //ersalTime=[time_id ,day,from,to]
    {
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
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            if ($card_array["info"]["exr_user_wallet"] >= $wallet) {
                if ($card_array["info"]["exr_user_wallet"] != 0 || $card_array["info"]["exr_user_wallet"] != null) {
                    if ($card_array["info"]["exr_pardakht_shode"] != $card_array["info"]["exr_final_price"] && $card_array["info"]["exr_pardakht_mande"] != 0) {
                        $card_array["info"]["exr_wallet"] += (intval($card_array["info"]["exr_user_wallet"]) - intval($wallet)); // TODO: check by Dr.
                        $card_array["info"]["exr_user_wallet"] += intval($wallet);    // TODO: check by Dr.
                        $card_array["info"]["exr_pardakht_shode"] += $wallet;

                        if ($card_array["info"]["exr_bedehkar"] < $wallet) {
                            $card_array["info"]["exr_pardakht_mande"] -= 0;
                            $card_array["info"]["exr_bedehkar"] -= 0;
                            $card_array["info"]["exr_bestankar"] += $wallet - $card_array["info"]["exr_bedehkar"];
                        } else {
                            $card_array["info"]["exr_pardakht_mande"] -= $wallet;
                            $card_array["info"]["exr_bedehkar"] -= $wallet;
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
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);

            if ($card_array["info"]["exr_bon"] >= $bon) {
                if ($card_array["info"]["exr_bon"] != 0 || $card_array["info"]["exr_bon"] != null) {
                    if ($card_array["info"]["pardakht_shode"] != $card_array["info"]["final_price"] && $card_array["info"]["pardakht_mande"] != 0) {
                        $card_array["info"]["exr_bon"] += (intval($card_array["info"]["exr_bon"]) - intval($bon)); // TODO: check by Dr.
                        $card_array["info"]["exr_bon"] += intval($bon);    // TODO: check by Dr.
                        $card_array["info"]["pardakht_shode"] += $bon;

                        if ($card_array["info"]["exr_bedehkar"] < $bon) {
                            $card_array["info"]["pardakht_mande"] -= 0;
                            $card_array["info"]["exr_bedehkar"] -= 0;
                            $card_array["info"]["exr_bestankar"] += $bon - $card_array["info"]["exr_bedehkar"];
                        } else {
                            $card_array["info"]["pardakht_mande"] -= $bon;
                            $card_array["info"]["exr_bedehkar"] -= $bon;
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

    public function affectPardakhtdargah($dargah, $dargah_id)
    {
        if (session()->has("card")) {
            $card_array = json_decode(session()->get("card"), true);
//            $card_array["info"]["exr_dargah"]+=$dargah;
            if ($card_array["info"]["pardakht_shode"] != $card_array["info"]["final_price"] && $card_array["info"]["pardakht_mande"] != 0) {
                $card_array["info"]["exr_dargah"] = $dargah;   //TODO: check by Dr.
                $card_array["info"]["exr_dargah_id"] = $dargah_id;
                $card_array["info"]["pardakht_shode"] += $dargah;

                if ($card_array["info"]["exr_bedehkar"] < $dargah) {
                    $card_array["info"]["pardakht_mande"] = 0;
                    $card_array["info"]["exr_bedehkar"] = 0;
                    $card_array["info"]["exr_bestankar"] += $dargah - $card_array["info"]["exr_bedehkar"];
                } else {
                    $card_array["info"]["pardakht_mande"] -= $dargah;
                    $card_array["info"]["exr_bedehkar"] -= $dargah;
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
    public function addSabadToDetailFinAndTransTables($dargah, $dargah_id, $karsheans_id = 0, $info = null, $transtype_id = 1)
    {

        if ($this->checkExistCardSession()) {
            $sabad_info = (array)json_decode(session()->get("card"), true);
//            $count = $sabad_info["info"]["count"];
//            $price = $sabad_info["product"]["price"];
            $total_price = $sabad_info["info"]["exr_total_price"];
            $final_price = $sabad_info["info"]["exr_final_price"];

//            $sum_takhfif = $sabad_info["info"]["sum_takhfif"];

            $wallet = $sabad_info["info"]["exr_wallet"];
            $wallet_trans = $sabad_info["info"]["exr_wallet_trans"];

            $bon = $sabad_info["info"]["exr_bon"];
            $bon_trans = $sabad_info["info"]["exr_bon_trans"];

            $pdargah = $sabad_info["info"]["exr_dargah"];
            $pdargah_id = $sabad_info["info"]["exr_dargah_id"];

            $sabad_info["info"]["exr_dargah"] = $dargah;
            $sabad_info["info"]["exr_dargah_id"] = ($dargah_id != null || $dargah_id != 0) ? $dargah_id : null;

            $pouse = $sabad_info["info"]["exr_pouse"];
            $pardakhti = $sabad_info["info"]["exr_pardakhti"];
            $naghdi = $sabad_info["info"]["exr_naghdi"];
            $enteghal = $sabad_info['info']['exr_enteghal'];

            $bedehkar = $sabad_info['info']["exr_bedehkar"];
            $bestankar = $sabad_info['info']["exr_bestankar"];

            $moghaierat = $sabad_info["info"]["exr_moghaierat"];
            $esterdadvajh = $sabad_info["info"]["exr_esterdadvajh"];
            $esterdad_wallet = $sabad_info["info"]["exr_esterdad_wallet"];
            $esterdad_card = $sabad_info["info"]["exr_esterdad_card"];

            if ($karsheans_id != 0)
                $sabad_info["info"]["karshenas_id"] = $karsheans_id;
            else
                $sabad_info["info"]["karshenas_id"] = null;

            if ($dargah == 0) $dargah = $pdargah;
            if ($dargah_id == null) $dargah_id = $pdargah_id;

            $customer_id = $sabad_info["info"]["user_id"] ?? 1;

//            $ersaltimes = $sabad_info["zaman_ersal"]; // todo: later
//            $peik = $sabad_info["peik"]; // todo: later
//            $addrs = $sabad_info["addrs"]; // todo: later

            $experting_id = $sabad_info["info"]["exr_experting_id"];
            $karshenasi_hazine = $sabad_info["info"]["karshenasi_hazine"];
            $total_price_experting = $sabad_info["info"]["exr_total_price"];

            DB::beginTransaction();

            //add expertingDetailFin
            $expertingDetailFin = new ExpertingDetailFin();
            $expertingDetailFin->description = json_encode($sabad_info["info"]);
            $expertingDetailFin->price = $karshenasi_hazine;
            $expertingDetailFin->esterdadvajh = $esterdadvajh;
            $expertingDetailFin->naghdi = $naghdi;
            $expertingDetailFin->enteghal = $enteghal;
            $expertingDetailFin->pouse = $pouse;
            $expertingDetailFin->dargah = $dargah;
            $expertingDetailFin->wallet = $wallet;
            $expertingDetailFin->wallet_trans = $wallet_trans;
            $expertingDetailFin->bon = $bon;
            $expertingDetailFin->bon_trans = $bon_trans;
            $expertingDetailFin->totalkharid = $total_price_experting;
            $expertingDetailFin->bedehkar = $bedehkar;
            $expertingDetailFin->experting_id =$sabad_info["info"]['exr_experting_id'];

            if ($expertingDetailFin->save()) {
                $expertingDetailFinTrans = new ExpertingDetailFinTrans();
                $expertingDetailFinTrans->info = json_encode($sabad_info["info"]);
                $expertingDetailFinTrans->price = $karshenasi_hazine;
                $expertingDetailFinTrans->wallet = $wallet;
                $expertingDetailFinTrans->enteghal = $enteghal;
                $expertingDetailFinTrans->dargah = $dargah;
                $expertingDetailFinTrans->pouse = $pouse;
                $expertingDetailFinTrans->naghdi = $naghdi;
                $expertingDetailFinTrans->moghaierat = $moghaierat;
                $expertingDetailFinTrans->esterdad_card = $esterdad_card;
                $expertingDetailFinTrans->esterdad_wallet = $esterdad_wallet;

                $expertingDetailFinTrans->detailfin_id = $expertingDetailFin->id;
                $expertingDetailFinTrans->transtype_id = 2;
                $expertingDetailFinTrans->gateway_id = $dargah_id;

                if ($expertingDetailFinTrans->save()) {
                    // change totalFin
                    $totalFins = TotalFin::where("user_id", $customer_id)->first();
                    $totalFins->etebar_naghdi_estefade += $naghdi;
                    $totalFins->mojodi_wallet -= $wallet;
                    $totalFins->mojodi_bon -= $bon;
                    $totalFins->sum_etebar_wallet_estefade += $wallet;
                    $totalFins->sum_etebar_bon_estefade += $bon;
                    $totalFins->sum_trans_dargah += $dargah;
                    $totalFins->sum_esterdad += $esterdadvajh;
                    $totalFins->sum_pouse += $pouse;
                    $totalFins->totalkharid += $total_price_experting;
                    $totalFins->pardakhti += ($wallet + $bon + $dargah + $naghdi); // @todo: check by Dr. added.
                    if ($totalFins->save()) {
                        //add totalFins transaction
                        $totalFinTrans = new TotalFinTrans();
                        $totalFinTrans->info =  json_encode($sabad_info["info"]);
                        $totalFinTrans->experting_price = $karshenasi_hazine;
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
                        $totalFinTrans->experting_detailfins_tran_id = $expertingDetailFinTrans->id;
                        $totalFinTrans->totalfins_id = $totalFins->id;

                        if ($totalFinTrans->save()) {
                            //change wallet
                            $user_wallet = UserWallet::where("user_id", $customer_id)->first();
                            $wallet_first_mojodi = $user_wallet->mojodi;
                            $user_wallet->mojodi -= $wallet;

                            if ($user_wallet->save()) {
                                //add wallet tarnsaction
                                $walletTrans = new UserWalletTrans();
                                $walletTrans->price = $wallet;
                                $walletTrans->status = "bardasht";
                                $walletTrans->firstmojodi = $wallet_first_mojodi;
                                $walletTrans->lastmojodi = ($wallet_first_mojodi - $wallet);
                                $walletTrans->experting_detailfins_tran_id = $expertingDetailFinTrans->id;
                                $walletTrans->user_wallet_id = $user_wallet->id;
                                if ($walletTrans->save()) {
                                    if (UserBon::where("user_id", $customer_id)->exists()){
                                        $userBon = UserBon::where("user_id", $customer_id)->first();
                                        $bon_first_mojodi = $userBon->cost;
                                        $userBon->cost -= $bon;
                                        if ($userBon->save()) {
                                            // add bon transaction
                                            $bonTrans = new UserBonTrans();
                                            $bonTrans->info =  json_encode($sabad_info["info"]);
                                            $bonTrans->price = $bon;
                                            $bonTrans->status = "bardasht";
                                            $bonTrans->firstmojodi = $bon_first_mojodi;
                                            $bonTrans->lastmojodi = ($bon_first_mojodi - $bon);
                                            $bonTrans->moghaierat = 0;
                                            $bonTrans->experting_detailfins_tran_id = $expertingDetailFinTrans->id;
                                            $bonTrans->user_bon_id = $userBon->id;
                                            if ($bonTrans->save()) {
                                                session()->forget("card");
                                                DB::commit();
                                                return "success";
                                            } else {
                                                DB::rollBack();
                                                return "userbontrans_failed";
                                            }
                                        } else {
                                            DB::rollBack();
                                            return "userbon_failed";
                                        }
                                    }
                                }
                                 DB::rollBack();
                                return "userWalletTrans-failed";
                            }
                             DB::rollBack();
                            return "userWallet-failed";
                        }
                         DB::rollBack();
                        return "totalFinsTrans-failed";
                    }
                     DB::rollBack();
                    return "totalFins-failed";
                }
                 DB::rollBack();
                return "DetailFinTrans-failed";
            }
             DB::rollBack();
            return "DetailFin-failed";

        }
        return "sabad-failed";
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
