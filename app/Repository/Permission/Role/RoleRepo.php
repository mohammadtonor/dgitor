<?php

namespace App\Repository\Permission\Role;

use App\Models\Permission\Role\Role;
use App\Repository\Contract\ACL\Role\RoleService;
use Illuminate\Support\Facades\DB;

class RoleRepo
{
    // ---------------------------------------- Page ---------------------------------------- //
    public function showRolePageInfo()
    {
        $pageInfo = [
            "count" => 0,
            "roles" => null
        ];
        if (DB::table("roles")->count() > 0)
        {
            $pageInfo["count"] = DB::table("roles")->count();
            $allRoles = Role::withTrashed()->get();
            foreach ($allRoles as $role)
            {
                $pageInfo["roles"][] = [
                    "role" => $role,
                    "user_count" => DB::table("role_user")->where("role_id", $role->id)->count(),
                ];
            }
        }
        return $pageInfo;
    }

    // ---------------------------------------- CRUD ---------------------------------------- //
    public function insertRole($name_en,$name_fa, $status)
    {
        if (!$this->checkExistsRoleByName(null, $name_en,$name_fa))
        {
            $role = new Role();
            $role->name_en = $name_en;
            $role->name_fa = $name_fa;
            $role->status = $status;
            return ($role->save()) ?
                ["status" => "success", "result" => $role] :
                ["status" => "failed"];
        }
        return ["status" => "duplicate"];
    }

    public function getRoleById($id)
    {
        if ($this->checkExistsRoleById($id))
            return Role::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function getAllRoles()
    {
        return $this->showRolePageInfo();
    }

    public function deleteRole($id)
    {
        if ($this->checkExistsRoleById($id))
        {
            if (DB::table("roles")->where("id", $id)->whereNull("deleted_at")->exists())
            {
                return (Role::where("id", $id)->delete()) ? "success" : "failed";
            }
            return "deleted";
        }
        return "notFound";
    }

    public function restoreRole($id)
    {
        if ($this->checkExistsRoleById($id))
        {
            if (DB::table("roles")->where("id", $id)->whereNotNull("deleted_at")->exists())
            {
                return (Role::withTrashed()->where("id", $id)->restore()) ? "success" : "failed";
            }
            return "notDeleted";
        }
        return "notFound";
    }

    public function updateRole($id, $name_en,$name_fa, $status)
    {
        if ($this->checkExistsRoleById($id)) {
            if (!$this->checkExistsRoleByName($id, $name_en,$name_fa)) {
                $role = $this->getRoleById($id);
                if ($name_en != null) $role->name_en = $name_en;
                if ($name_fa != null) $role->name_fa = $name_fa;
                if ($status != null) $role->status = $status;
                return ($role->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    // ---------------------------------------- Operation ---------------------------------------- //
    public function checkExistsRoleById($id)
    {
        return DB::table("roles")->where("id", $id)->exists();
    }

    public function checkExistsRoleByName($id, $name_en,$name_fa)
    {
        if ($name_en == null || $name_fa==null) return true;

        $roles = DB::table("roles");
        if ($id != null) $roles->where("id", "<>", $id);
        $roles->where(["name_en"=>$name_en,"name_fa"=>$name_fa]);
        return $roles->exists();
    }

    // ---------------------------------------- Relations ---------------------------------------- //


}
