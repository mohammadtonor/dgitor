<?php

namespace App\Http\Controllers\Admin\Permission\SpecPermission;

use App\Http\Controllers\Controller;
use App\Repository\Permission\SpecPermission\BlockPermissionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockPermissionsController extends Controller
{
    private $blockPermissionRepo;
    public function __construct(BlockPermissionRepo $blockPermissionRepo)
    {
        $this->blockPermissionRepo = $blockPermissionRepo;
    }

    public function showBlockPermissionPage($user_id)
    {
        $result = $this->blockPermissionRepo->showBlockPermissionPage($user_id);
        return response()->json($result);
    }

    public function getAllBlockPermissionOfUser($user_id)
    {
        return response()->json(["status" => $this->blockPermissionRepo->getAllBlockPermissionOfUser($user_id)]);
    }

    public function attachBlockPermissionToUser($user_id,$permission_id)
    {
        return response()->json(["status" => $this->blockPermissionRepo->attachBlockPermissionToUser($user_id,$permission_id)]);
    }

    public function detachBlockPermissionFormUser($user_id,$permission_id)
    {
        return response()->json(["status" => $this->blockPermissionRepo->detachBlockPermissionFromUser($user_id,$permission_id)]);
    }

    public function removeAllBlockPermissionFromUser($user_id)
    {
        return response()->json(["status" => $this->blockPermissionRepo->removeAllBlockPermissionFromUser($user_id)]);
    }

    public function getAllBlockPermissionCanAssignForUser($user_id)
    {
        return response()->json(["status" => $this->blockPermissionRepo->getAllBlockPermissionCanAssignForUser($user_id)]);
    }

    public function syncBlockPermissionToUser(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            "permission_ids" => "required|array",
            "permission_ids.*" => "numeric"
        ]);

        if ($validator->fails())
            return response()->json(["status" => "validation_failed", "error" => $validator->errors()]);

        return response()->json(["status" => $this->blockPermissionRepo->syncBlockPermissionToUser($user_id, $request->permission_ids)]);
    }
}
