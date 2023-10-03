<?php

namespace App\Repository\PeriodicService\PeriodicService;

use App\Models\PeriodicService\PeriodicService\PeriodicService;
use Illuminate\Support\Facades\DB;

class PeriodicServiceRepo
{


    //////////////////////////////// CRUD

    public function insertPeriodicService($title,
                                          $end, $periodic_count,
                                          $first_side_confirm, $second_side_confirm,
                                          $product1_price, $product2_price,
                                          $mavotafavot, $payer_mavotafavot,
                                          $product1_id, $product2_id, $pre_product_id,
                                          $product1_category_id, $product2_category_id, $register_user_id)
    {
        $periodicService = new PeriodicService();
        $periodicService->title = $title;
        $periodicService->end = $end;
        $periodicService->periodic_count = $periodic_count;
        $periodicService->first_side_confirm = $first_side_confirm;
        $periodicService->second_side_confirm = $second_side_confirm;
        $periodicService->product1_price = $product1_price;
        $periodicService->product2_price = $product2_price;
        $periodicService->mavotafavot = $mavotafavot;
        $periodicService->payer_mavotafavot = $payer_mavotafavot;
        $periodicService->product1_id = $product1_id;
        $periodicService->product2_id = $product2_id;
        $periodicService->pre_product_id = $pre_product_id;
        $periodicService->product1_category_id = $product1_category_id;
        $periodicService->product2_category_id = $product2_category_id;
        $periodicService->register_user_id = $register_user_id;
        return ($periodicService->save()) ? ["status" => "success", "result" => $periodicService] : ["status" => "failed"];

    }

    public function selectPeriodicServiceById($id)
    {
        if ($this->checkExistsPeriodicServiceById($id))
            return PeriodicService::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllPeriodicServices()
    {
        return (PeriodicService::withTrashed()->get()->count() > 0) ? PeriodicService::withTrashed()->get() : "notFound";
    }

    public function updatePeriodicService($id, $title,
                                          $end, $periodic_count,
                                          $first_side_confirm, $second_side_confirm,
                                          $product1_price, $product2_price,
                                          $mavotafavot, $payer_mavotafavot,
                                          $product1_id, $product2_id, $pre_product_id,
                                          $product1_category_id, $product2_category_id, $register_user_id)
    {
        if ($this->checkExistsPeriodicServiceById($id)) {
            $periodicService = $this->selectPeriodicServiceById($id);
            if ($title != null) $periodicService->title = $title;
            if ($end != null) $periodicService->end = $end;
            if ($periodic_count != null) $periodicService->periodic_count = $periodic_count;
            if ($first_side_confirm != null) $periodicService->first_side_confirm = $first_side_confirm;
            if ($second_side_confirm != null) $periodicService->second_side_confirm = $second_side_confirm;
            if ($product1_price != null) $periodicService->product1_price = $product1_price;
            if ($product2_price != null) $periodicService->product2_price = $product2_price;
            if ($mavotafavot != null) $periodicService->mavotafavot = $mavotafavot;
            if ($payer_mavotafavot != null) $periodicService->payer_mavotafavot = $payer_mavotafavot;
            if ($product1_id != null) $periodicService->product1_id = $product1_id;
            if ($product2_id != null) $periodicService->product2_id = $product2_id;
            if ($pre_product_id != null) $periodicService->pre_product_id = $pre_product_id;
            if ($product1_category_id != null) $periodicService->product1_category_id = $product1_category_id;
            if ($product2_category_id != null) $periodicService->product2_category_id = $product2_category_id;
            if ($register_user_id != null) $periodicService->register_user_id = $register_user_id;
            return ($periodicService->save()) ? ["status" => "success"] : ["status" => "failed"];
        }
        return "notFound";
    }

    public function deletePeriodicService($id)
    {
        if ($this->checkExistsPeriodicServiceById($id))
            return PeriodicService::where("id", $id)->delete() ? "success" : "failed";
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

    public function addPeriodicService(
        $product_service_id, $title, $description, $start_contract_date, $start_date, $how_long, $periodic_time, $register_user_id, $product1_id, $product2_id = null, $pre_product_id = null
    )
    {
        if (DB::table('products')->where('id', $product1_id)->exists()) $product1 = DB::table('products')->where('id', $product1_id)->first(); else return "product1_notFound";
        if ($product_service_id == '1') {
            if ($product2_id != null) if (DB::table('products')->where('id', $product2_id)->exists()) $product2 = DB::table('products')->where('id', $product2_id)->first(); else return "product2_notFound";
            if ($pre_product_id != null) if (DB::table('pre_products')->where('id', $pre_product_id)->exists()) $preProduct = DB::table('pre_products')->where('id', $pre_product_id)->first(); else return "preProduct_notFound";
        }

        $total_day = 0;
        switch ($how_long) {
            case 'day':
                $total_day = 1;
                break;
            case 'week':
                $total_day = 7;
                break;
            case 'month':
                $total_day = 30;
                break;
            case '3 month':
                $total_day = 30 * 3;
                break;
            case '6 month':
                $total_day = 30 * 6;
                break;
            case '9 month':
                $total_day = 30 * 9;
                break;
            case 'year':
                $total_day = 365;
                break;
        }

//        $periodic_service_count = (int)($total_day / $periodic_time);
        $periodic_service_count = ($total_day % $periodic_time) == 0 ? (int)($total_day / $periodic_time) : (int)(($total_day / $periodic_time) + 1);

        $periodicService = new PeriodicService();
        $periodicService->title = $title;
        $periodicService->description = $description;
        $periodicService->periodic_count = $periodic_service_count;

        $periodic_service_product1_price = $this->getFinalPrice($product1_id) * $periodic_service_count;
        $periodicService->product1_price = $periodic_service_product1_price;
        if ($product_service_id == '2') { // product_service_id :     kharid = 1 | exchange = 2
            if ($product2_id != 0) {
                $periodic_service_product2_price = $this->getFinalPrice($product2_id);
                $periodicService->product2_price = $periodic_service_product2_price;
                $periodicService->mavotafavot = ($periodic_service_product2_price - $periodic_service_product1_price < 0) ?
                    $periodic_service_product1_price - $periodic_service_product2_price :
                    $periodic_service_product2_price - $periodic_service_product1_price;
                $periodicService->payer_mavotafavot = ($periodic_service_product1_price != $periodic_service_product2_price) ? ($periodic_service_product1_price < $periodic_service_product2_price) ? '1' : '2' : null;
                $periodicService->product2_id = $product2_id;
                $periodicService->product2_category_id = $product2->category_id;
            } elseif ($pre_product_id != 0) {
                $periodicService->pre_product_id = $pre_product_id;
            }
        }
        $periodicService->product1_id = $product1_id;
        $periodicService->product1_category_id = $product1->category_id;
        $periodicService->register_user_id = $register_user_id;
        $periodicService->product_service_id = $product_service_id;

        if ($periodicService->save()) {
            $periodicServiceTime = DB::table('periodic_service_times')->insert([
                "start_contract_date" => $start_contract_date,
                "start_date" => $start_date,
                "periodic_time" => $periodic_time,
                "how_long" => $how_long,
                "periodic_service_id" => $periodicService->id
            ]);
            if ($periodicServiceTime){
                return "success";
            }else{
                return "periodicServiceTime_failed";
            }
        } else {
            return "periodicService_failed";
        }
    }

    public function confirm1_periodic_service($periodic_service_id)
    {
        if (PeriodicService::where('id', $periodic_service_id)->exists()) {
            $periodic_service = PeriodicService::where('id', $periodic_service_id)->first();

            $periodic_service->first_side_confirm = '1';
            return ($periodic_service->save()) ? "success" : "failed";
        } else {
            return "periodic_service_notFound";
        }
    }

    public function confirm2_periodic_service($periodic_service_id)
    {
        if (PeriodicService::where('id', $periodic_service_id)->exists()) {
            $periodic_service = PeriodicService::where('id', $periodic_service_id)->first();

            $periodic_service->second_side_confirm = '1';
            return ($periodic_service->save()) ? "success" : "failed";
        } else {
            return "periodic_service_notFound";
        }
    }

    public function get_payer_mavotafavot($periodic_service_id)
    {
        if (PeriodicService::where('id', $periodic_service_id)->exists()) {
            $periodic_service = PeriodicService::where('id', $periodic_service_id)->first();
            $payer_mavatafavot = $periodic_service->payer_mavotafavot;
            $field = 'register_user' . $payer_mavatafavot . '_id';
            return $periodic_service->$field;
        } else {
            return "exchange_notFound";
        }
    }

    //////////////////////////////// Operation

    public function checkExistsPeriodicServiceById($id)
    {
        return DB::table("periodic_services")->where("id", "=", $id)->exists();
    }

    public function checkExistsPeriodicServiceByTitle($periodicd_service_id, $title = null)
    {
        if ($title == null)
            return true;

        $periodicd_services = DB::table("exchange_statuses");
        if ($periodicd_service_id != null) $periodicd_services->where("id", "<>", $periodicd_service_id);
        if ($title != null) $periodicd_services->where("title_en", $title);
        return $periodicd_services->exists();
    }

    //////////////////////////////// Relation


}
