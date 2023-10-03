<?php

namespace App\Repository\Organization\Holding;

use App\Models\Organization\Holding\Holding;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HoldingRepo
{
    //////////////////////////////// Page
    public function showHoldingPageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "holdings" => null,
        ];
            $holdings = Holding::withTrashed()->get();
            $pageInfo["count"] = $holdings->count();
            foreach ($holdings as $holding) {

                $pageInfo["holdings"][] = [
                    "id" => $holding->id,
                    "title" => $holding->title,
                    "desc" => $holding->descripton,
                    "organizations" => $holding->organizations
                ];
        }

        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertHolding($title, $desc)
    {
        $holding = new Holding();
        $holding->title = $title;
        $holding->description = $desc;
        return ($holding->save()) ? ["status" => "success", "result" => $holding] : ["status" => "failed"];
    }

    public function selectHoldingById($id)
    {
        if ($this->checkExistsHoldingById($id))
            return Holding::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllHoldings()
    {
        return (Holding::withTrashed()->get()->count() > 0) ? Holding::withTrashed()->get() : "notFound";
    }

    public function updateHolding($id, $title, $desc)
    {
        if ($this->checkExistsHoldingById($id)) {
            $holding = $this->selectHoldingById($id);
            if ($title != null) $holding->title = $title;
            if ($desc != null) $holding->description = $desc;
            return ($holding->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deleteHolding($id)
    {
        if ($this->checkExistsHoldingById($id))
            return Holding::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsHoldingById($id)
    {
        return DB::table("holdings")->where("id", "=", $id)->exists();
    }

    public function checkExistsHoldingByTitle($holding_id, $title = null)
    {
        if ($title == null)
            return true;

        $holding = DB::table("holdings");
        if ($holding_id != null) $holding->where("id", "<>", $holding_id);
        if ($title != null) $holding->where("title", $title);
        return $holding->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
