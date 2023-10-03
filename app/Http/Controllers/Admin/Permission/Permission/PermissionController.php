<?php

namespace App\Http\Controllers\Admin\Permission\Permission;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AjaxCheckMiddleware;
use App\Repository\Permission\Permission\PermissionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    private $permissionRepo;
    public function __construct(PermissionRepo $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function showPermissionInfo()
    {
        $result = $this->permissionRepo->showPageInfo();
        // ToDo : Return View
    }

    public function insertPermission(Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name_en" => 'required|string|max:100',
                "name_fa" => 'required|string|max:100',
            ]);
            if ($validator->fails())
                return response()->json(["status"=>"validation-error", "errors"=>$validator->errors()]);

            return response()->json(["status"=>$this->permissionRepo->insert(
                $request->name_en,
                $request->name_fa
            )]);
        }

        return  response()->json(["status"=>"refused"]);
    }

    public function selectPermissionById($permission_id)
    {
        return response()->json(["status"=>$this->permissionRepo->getPermissionById($permission_id)]);
    }

    public function getAllPermissions()
    {
        return response()->json(["status"=>$this->permissionRepo->getAllPermissions()]);
    }

    public function updatePermission($permission_id, Request $request)
    {
        if ($request->hasHeader("accept") && $request->header("accept") == "application/json" && $request->ajax())
        {
            $validator = Validator::make($request->all(), [
                "name_en" => 'nullable|string|max:100',
                "name_fa" => 'nullable|string|max:100',
            ]);
            if ($validator->fails())
                return  response()->json(["status" => "validation-error", "errors" => $validator->errors()]);

            return response()->json(["status"=>$this->permissionRepo->update($permission_id,
                $request->name_en ??null,
                $request->name_fa ??null)]);
        }

        return response()->json(["status"=>"refused"]);
    }

    public function deletePermission($permission_id)
    {
        return response()->json(["status" => $this->permissionRepo->deletePermissionById($permission_id)]);
    }

}
