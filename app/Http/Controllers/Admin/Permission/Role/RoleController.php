<?php

namespace App\Http\Controllers\Admin\Permission\Role;

use App\Http\Controllers\Controller;
use App\Repository\Contract\ACL\Role\RoleService;
use App\Repository\Permission\Role\RoleRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RoleController extends Controller
{
    private $roleRepo;

    public function __construct(RoleRepo $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }


    public function showPageInfo()
    {
        $result = response()->json($this->roleRepo->showRolePageInfo());
        // TODO : Return View
        return View("Pannel.Settings.Semats",compact("result"));
    }

    public function getAllRole()
    {
        return $this->roleRepo->getAllRoles();
    }

//    public function getAllRole()
//    {
//        return $this->roleRepo->getAllRoles();
//    }

    public function insertRole(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "name" => 'required',
                "status" => "required"
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json($this->roleRepo->insertRole(
                $request->name ?? null,
                $request->status ?? null,
            ));
        }
        return response()->json(["status" => "refused"]);
    }

    public function selectRoleById($role_id)
    {
        return response()->json(["status" => $this->roleRepo->selectRoleById($role_id)]);
    }

    public function updateRole(Request $request, $role_id)
    {

        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax()) {
            $validator = Validator::make($request->all(), [
                "name" => 'nullable',
                "status" => 'nullable',
            ]);
            if ($validator->fails())
                return response()->json(["status" => "validation-error", "errors" => $validator->errors()]);
            return response()->json(["status" => $this->roleRepo->updateRole($role_id,
                $request->name ?? null,
                $request->status ?? null,
            )]);
        }
        return response()->json(["status" => "refused"]);
    }

    public function deleteRole($role_id)
    {
        return response()->json(["status" => $this->roleRepo->deleteRole($role_id)]);
    }

    public function restoreRole($role_id)
    {
        return response()->json(["status" => $this->roleRepo->restoreRole($role_id)]);
    }
}
