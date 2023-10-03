<?php

namespace App\Http\Controllers\Admin\Permission\PermissionRoleRelation;

use App\Http\Controllers\Controller;
use App\Repository\Permission\PermissionRoleRelation\PermissionRoleRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionRoleRelationController extends Controller
{
    private $permissionRoleRepo;
    public function __construct(PermissionRoleRepo $permissionRoleRepo)
    {
        $this->permissionRoleRepo = $permissionRoleRepo;
    }

    public function showPagePermissionOfRole()
    {
        return response()->json(["status"=>$this->permissionRoleRepo->showPagePermissionOfRole()]);
        // ToDo : Return View
    }

    public function getAllRole()
    {
        return response()->json(["status"=>$this->permissionRoleRepo->getAllRole()]);
    }

    public function getAllPermissionNotInRolePermission($role_id)
    {
        return response()->json(["status"=>$this->permissionRoleRepo->getAllPermissionNotInRolePermission($role_id)]);
    }

    public function syncPermissionsToRole($role_id,Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "permission_ids"   => 'required|array',
                "permission_ids.*" => 'required|numeric',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status"=>$this->permissionRoleRepo->syncPermissionsToRole($role_id, $request->permission_ids)]);
        }
        return  response()->json(["status"=>"refused"]);
    }

    public function attachPermissionToRole(Request $request, $role_id)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "permission_ids"   => 'required|array',
                "permission_ids.*" => 'required|numeric',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status" => $this->permissionRoleRepo->attachPermissionToRole($role_id, $request->permission_ids)]);
        }
    }

    public function detachPermssionFromRole($role_id,$permission_id)
    {
        return response()->json(["status" => $this->permissionRoleRepo->detachPermissionFromRole($role_id, $permission_id)]);
    }

    public function getAllPermissionOfRole($role_id)
    {
        return response()->json(["status" => $this->permissionRoleRepo->getAllPermissionOfRole($role_id)]);
    }

    public function removeAllPermissionOfRole($role_id)
    {
        return response()->json(["status" => $this->permissionRoleRepo->removeAllPermissionOfRole($role_id)]);
    }

    public function getAllRoleHasPermission($permission_id)
    {
        return response()->json(["status" => $this->permissionRoleRepo->getAllRoleHasPermission($permission_id)]);
    }
}
