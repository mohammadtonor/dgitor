<?php

namespace App\Http\Controllers\Admin\Permission\FinalPermissionUtils;

use App\Http\Controllers\Controller;
use App\Repository\Permission\FinalPermissionUtils\FinalPermissionUtilsRepo;

class FinalPermissionUtilsController extends Controller
{
    private $finalPermissionUtilsRepo;
    public function __construct(FinalPermissionUtilsRepo $finalPermissionUtilsRepo)
    {
        $this->finalPermissionUtilsRepo = $finalPermissionUtilsRepo;
    }

    public function getFinalPermissionIdsOfUser($user_id)
    {
        return response()->json(["status" => $this->finalPermissionUtilsRepo->getFinalPermissionIdsOfUser($user_id)]);
    }
}
