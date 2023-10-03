<?php

namespace App\Http\Controllers\Admin\Permission\RoleUserRelation;

use App\Http\Controllers\Controller;
use App\Repository\Permission\RoleUserRelation\RoleUserRelationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleUserRelationController extends Controller
{
    private $roleUserRelationRepo;
    public function __construct(RoleUserRelationRepo $roleUserRelationRepo)
    {
        $this->roleUserRelationRepo = $roleUserRelationRepo;
    }

    public function showPageRoleOfuser($user_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->showPageRoleOfuser($user_id)]);
    }

    public function getAllRoleOfUser($user_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->getAllRoleOfUser($user_id)]);
    }

    public function syncRolesForUser($user_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "role_ids"   => 'required',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->roleUserRelationRepo->syncRolesForUser($user_id,$request->role_ids)]);
        }

        return  response()->json(["status"=>"refused"]);
    }

    public function attachRoleToUser($user_id,$role_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->attachRoleToUser($user_id,$role_id)]);
    }

    public function detachRoleFromUser($user_id,$role_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->detachRoleFromUser($user_id,$role_id)]);
    }

    public function deleteAllRoleOfUser($user_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->deleteAllRoleOfUser($user_id)]);
    }

    public function getRolesNotHasUser($user_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->getRolesNotHasUser($user_id)]);
    }

    public function getAllUserHasRole($role_id)
    {
        return response()->json(["status" => $this->roleUserRelationRepo->getAllUserHasRole($role_id)]);
    }
}
