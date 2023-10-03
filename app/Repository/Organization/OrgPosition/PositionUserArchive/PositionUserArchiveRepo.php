<?php

namespace App\Repository\Organization\OrgPosition\PositionUserArchive;

use App\Models\Organization\OrgPosition\PositionUserArchive\PositionUserArchive;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PositionUserArchiveRepo
{
    //////////////////////////////// Page
    public function showPositionUserArchivePageInfo($user_id)
    {
        $pageInfo = [
            "count"=>0,
            "positionUserArchives"=>null,
        ];
        if (PositionUserArchive::where("user_id", $user_id)->exists())
        {
            $positionUserArchives = PositionUserArchive::with(["org_position", "user"])->where("user_id", $user_id)->get();
            $pageInfo["count"] = DB::table("position_user_archives")->where("user_id", $user_id)->count();

            foreach ($positionUserArchives as $positionUserArchive)
            {
                $pageInfo["positionUserArchives"][] = [
                    "positionUserArchive" => $positionUserArchive
                ];
            }
        }


        return $pageInfo;
    }

    //////////////////////////////// CRUD

    public function insertPositionUserArchive($position_id, $user_id)
    {
        $positionUserArchive = new PositionUserArchive();
        $positionUserArchive->position_id = $position_id;
        $positionUserArchive->user_id = $user_id;
        return ($positionUserArchive->save()) ? ["status" => "success", "result" => $positionUserArchive] : ["status" => "failed"];
    }

    public function selectPositionUserArchiveById($id)
    {
        if ($this->checkExistsPositionUserArchiveById($id))
            return PositionUserArchive::where("id", $id)->first();
        return "notFound";
    }

    public function selectAllPositionUserArchives()
    {
        return (PositionUserArchive::withTrashed()->get()->count() > 0) ? PositionUserArchive::withTrashed()->get() : "notFound";
    }

    public function updatePositionUserArchive($id, $position_id, $user_id)
    {
        if ($this->checkExistsPositionUserArchiveById($id)) {
            $positionUserArchive = $this->selectPositionUserArchiveById($id);
            if ($position_id != null) $positionUserArchive->position_id = $position_id;
            if ($user_id != null) $positionUserArchive->user_id = $user_id;
            return ($positionUserArchive->save()) ? "success" : "failed";
        }
        return "notFound";
    }

    // حذف ادرس کاربر
    public function deletePositionUserArchive($id)
    {
        if ($this->checkExistsPositionUserArchiveById($id))
            return PositionUserArchive::where("id", $id)->delete() ? "success" : "failed";
        return "notFound";
    }

    //////////////////////////////// Operation

    public function checkExistsPositionUserArchiveById($id)
    {
        return DB::table("position_user_archives")->where("id", "=", $id)->exists();
    }

    public function checkTimeIsNull($time)
    {
        if ($time == null)
            return "-";
        return jdate(Carbon::parse($time))->format('%A, %d %B %y');
    }
}
