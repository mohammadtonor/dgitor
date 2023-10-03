<?php

namespace App\Http\Controllers\Admin\Permission\SpecPermission;

use App\Http\Controllers\Controller;
use App\Repository\Permission\SpecPermission\VipPermissionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VipPermissionsController extends Controller
{
    private $vipPermissionRepo;
    public function __construct(VipPermissionRepo $vipPermissionRepo)
    {
        $this->vipPermissionRepo = $vipPermissionRepo;
    }

    public function showVipPermissionPage($user_id)
    {
        $result =  $this->vipPermissionRepo->showVipPermissionPage($user_id);
//        dd($result);
        return View("Pannel.Personnel.PersonnelVipPermission",compact("result"));
    }

    public function getAllVipPermissionForUser($user_id)
    {
        return response()->json(["status" => $this->vipPermissionRepo->getAllVipPermissionForUser($user_id)]);
    }

    public function getAllPermissionCanAssignForUser($user_id)
    {
        return response()->json(["status" => $this->vipPermissionRepo->getAllPermissionCanAssignForUser($user_id)]);
    }

    public function attachVipPermissionToUser($user_id,$permission_id)
    {
        return response()->json(["status" => $this->vipPermissionRepo->attachVipPermissionToUser($user_id, $permission_id)]);
    }

    public function detachVipPermissionFromUser($user_id,$permission_id)
    {
        return response()->json(["status" => $this->vipPermissionRepo->detachVipPermissionFromUser($user_id, $permission_id)]);
    }

    public function removeAllVipPermissionFromUser($user_id)
    {
        return response()->json(["status" => $this->vipPermissionRepo->removeAllVipPermissionFromUser($user_id)]);
    }

    public function syncVipPermissionToUser(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            "permission_ids" => "required|array",
            "permission_ids.*" => "numeric"
        ]);

        if ($validator->fails())
            return response()->json(["status" => "validation-failed", "error" => $validator->errors()]);

        return response()->json(["status" => $this->vipPermissionRepo->syncVipPermissionToUser($user_id, $request->permission_ids)]);
    }
}
