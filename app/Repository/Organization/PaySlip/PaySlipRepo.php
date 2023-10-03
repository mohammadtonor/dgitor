<?php

namespace App\Repository\Organization\PaySlip;

use App\Models\Organization\PaySlip\PaySlip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaySlipRepo
{
    //////////////////////////////// Page
    public function showPaySlipPageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "paySlips"=>null,
        ];
        if (PaySlip::where("user_id", "=", $user_id)->exists())
        {
            $paySlips = PaySlip::with(["position_pay_salaries", "user"])->where("user_id", "=", $user_id)->get();
            $pageInfo["count"] = DB::table("pay_slips")->count();

            foreach ($paySlips as $paySlip)
            {
                $pageInfo["paySlips"][] = [
                    "paySlip" => $paySlip
                ];
            }
        }
        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPaySlip($title, $haghe_jazb, $salary, $base_salary,
                                  $ayab_zohab, $overtime, $food_cost, $manateghe_khas,
                                  $haghe_olad, $haghe_maskan,
                                  $haghe_mamoriat, $boun, $jame_pardakhti, $khales_pardakhti,
                                  $talab, $aghsat_vam, $maliat, $bime,
                                  $bime_takmili, $bime_dandanpezeshki, $haghe_sandogh, $mosaedeh,
                                  $month_number, $count_day_karkard, $kasre_kar, $user_id)
    {
        $PaySlip = new PaySlip();
        $PaySlip->title = $title;
        $PaySlip->haghe_jazb = $haghe_jazb;
        $PaySlip->salary = $salary;
        $PaySlip->base_salary = $base_salary;
        $PaySlip->ayab_zohab = $ayab_zohab;
        $PaySlip->overtime = $overtime;
        $PaySlip->food_cost = $food_cost;
        $PaySlip->manateghe_khas = $manateghe_khas;
        $PaySlip->haghe_olad = $haghe_olad;
        $PaySlip->haghe_maskan = $haghe_maskan;
        $PaySlip->haghe_mamoriat = $haghe_mamoriat;
        $PaySlip->boun = $boun;
        $PaySlip->jame_pardakhti = $jame_pardakhti;
        $PaySlip->khales_pardakhti = $khales_pardakhti;
        $PaySlip->talab = $talab;
        $PaySlip->aghsat_vam = $aghsat_vam;
        $PaySlip->maliat = $maliat;
        $PaySlip->bime = $bime;
        $PaySlip->bime_takmili = $bime_takmili;
        $PaySlip->bime_dandanpezeshki = $bime_dandanpezeshki;
        $PaySlip->haghe_sandogh = $haghe_sandogh;
        $PaySlip->mosaedeh = $mosaedeh;
        $PaySlip->month_number = $month_number;
        $PaySlip->count_day_karkard = $count_day_karkard;
        $PaySlip->kasre_kar = $kasre_kar;
        $PaySlip->user_id = $user_id;
        return ($PaySlip->save()) ? ["status" => "success", "result" => $PaySlip] : ["status" => "failed"];
    }

    public function selectPaySlipById($id)
    {
        if ($this->checkExistsPaySlipById($id))
            return PaySlip::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllPaySlips()
    {
        return (PaySlip::withTrashed()->get()->count() > 0) ? PaySlip::withTrashed()->get() : "notFound";
    }

    public function updatePaySlip($id, $title, $haghe_jazb, $salary, $base_salary,
                                       $ayab_zohab, $overtime, $food_cost, $manateghe_khas,
                                       $haghe_olad, $haghe_maskan,
                                       $haghe_mamoriat, $boun, $jame_pardakhti, $khales_pardakhti,
                                       $talab, $aghsat_vam, $maliat, $bime,
                                       $bime_takmili, $bime_dandanpezeshki, $haghe_sandogh, $mosaedeh,
                                       $month_number, $count_day_karkard, $kasre_kar, $user_id)
    {
        if ($this->checkExistsPaySlipById($id)) {
            $PaySlip = $this->selectPaySlipById($id);
            if ($title != null) $PaySlip->title = $title;
            if ($haghe_jazb != null) $PaySlip->haghe_jazb = $haghe_jazb;
            if ($salary != null) $PaySlip->salary = $salary;
            if ($base_salary != null) $PaySlip->base_salary = $base_salary;
            if ($ayab_zohab != null) $PaySlip->ayab_zohab = $ayab_zohab;
            if ($overtime != null) $PaySlip->overtime = $overtime;
            if ($food_cost != null) $PaySlip->food_cost = $food_cost;
            if ($manateghe_khas != null) $PaySlip->manateghe_khas = $manateghe_khas;
            if ($haghe_olad != null) $PaySlip->haghe_olad = $haghe_olad;
            if ($haghe_maskan != null) $PaySlip->haghe_maskan = $haghe_maskan;
            if ($haghe_mamoriat != null) $PaySlip->haghe_mamoriat = $haghe_mamoriat;
            if ($boun != null) $PaySlip->boun = $boun;
            if ($jame_pardakhti != null) $PaySlip->jame_pardakhti = $jame_pardakhti;
            if ($khales_pardakhti != null) $PaySlip->khales_pardakhti = $khales_pardakhti;
            if ($talab != null) $PaySlip->talab = $talab;
            if ($aghsat_vam != null) $PaySlip->aghsat_vam = $aghsat_vam;
            if ($maliat != null) $PaySlip->maliat = $maliat;
            if ($bime != null) $PaySlip->bime = $bime;
            if ($bime_takmili != null) $PaySlip->bime_takmili = $bime_takmili;
            if ($bime_dandanpezeshki != null) $PaySlip->bime_dandanpezeshki = $bime_dandanpezeshki;
            if ($haghe_sandogh != null) $PaySlip->haghe_sandogh = $haghe_sandogh;
            if ($mosaedeh != null) $PaySlip->mosaedeh = $mosaedeh;
            if ($month_number != null) $PaySlip->month_number = $month_number;
            if ($count_day_karkard != null) $PaySlip->count_day_karkard = $count_day_karkard;
            if ($kasre_kar != null) $PaySlip->kasre_kar = $kasre_kar;
            if ($user_id != null) $PaySlip->user_id = $user_id;

            return ($PaySlip->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deletePaySlip($id)
    {
        if ($this->checkExistsPaySlipById($id))
            return PaySlip::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPaySlipById($id)
    {
        return DB::table("pay_slips")->where("id", "=", $id)->exists();
    }

    public function checkExistsPaySlipByTitle($paySlip_id, $title = null)
    {
        if ($title == null)
            return true;

        $paySlip = DB::table("pay_slips");
        if ($paySlip_id != null) $paySlip->where("id", "<>", $paySlip_id);
        if ($title != null) $paySlip->where("title", $title);
        return $paySlip->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
