<?php

namespace App\Repository\Permission\SpecPermission;

use App\Models\Permission\Permission\Permission;
use App\Models\User;
use App\Repository\Contract\ACL\SpecPermission\VipPermissionService;
use Illuminate\Support\Facades\DB;

class VipPermissionRepo
{
    ////////////////////////////////////////page

    public function showVipPermissionPage($user_id)
    {
        $pageInfo = [
            "count" => 0,
            "user" => $this->getUserById($user_id),
            "permissions" => null,
            "canpermissions" => null
        ];

        if ($this->checkExistUserById($user_id))
        {
            if (DB::table("vip_permission")->where("user_id", $user_id)->exists())
            {
                $pageInfo["count"] = DB::table("vip_permission")->where("user_id", $user_id)->count();
                $pageInfo["permissions"] = $this->getAllVipPermissionForUser($user_id);
                $pageInfo["canpermissions"] = $this->getAllPermissionCanAssignForUser($user_id);
            }
            else
            {
                $pageInfo["canpermissions"] = $this->getAllPermissionCanAssignForUser($user_id);
            }
        }
        else
        {
            return "user_notFound";
        }
        return $pageInfo;
    }

    ////////////////////////////////////////crud

    //get all vip permission of user
    public function getAllVipPermissionForUser($user_id)
    {
        if ($this->checkExistUserById($user_id))
        {
            if (DB::table("vip_permission")->where("user_id", $user_id)->exists())
            {
                return DB::table("permissions")->whereIn("id",
                                                                    DB::table("vip_permission")
                                                                        ->where("user_id", $user_id)
                                                                        ->pluck("permission_id")
                                                                        ->toArray())
                                                                ->get();
            }
            return "permission-notFound";
        }
        return "user-notFound";
    }

    //attach vip permission to user
    public function attachVipPermissionToUser($user_id, $permission_id)
    {
        if (!$this->checkExistVipPermissionForUser($user_id, $permission_id))
        {
            return (DB::table("vip_permission")->insert(["user_id" => $user_id, "permission_id" => $permission_id]) > 0) ? "success" : "failed";
        }
        return "permission-exists";
    }

    //remove vip permission from user
    public function detachVipPermissionFromUser($user_id, $permission_id)
    {
        if ($this->checkExistVipPermissionForUser($user_id, $permission_id))
        {
            return (DB::table("vip_permission")->where(["user_id" => $user_id, "permission_id" => $permission_id])->delete() > 0)
                ? "success" : "failed";
        }
        return "permission-not-exists";
    }

    //remove all vip permission from user
    public function removeAllVipPermissionFromUser($user_id)
    {
        if (DB::table("vip_permission")->where("user_id", $user_id)->exists())
        {
            return (DB::table("vip_permission")->where("user_id", $user_id)->delete() > 0) ? "success" : "failed";
        }
        return "notFound";
    }

    // sync Vip permission
    public function syncVipPermissionToUser($user_id, $permission_ids)
    {
        if ($this->checkExistUserById($user_id))
        {
            $user = $this->getUserById($user_id);
            $canAssignPermissionForUser = $this->getAllPermissionCanAssignForUser($user_id);

            foreach ($permission_ids as $permission_id) {
                if (!in_array($permission_id, $canAssignPermissionForUser["permission_ids"]))
                {
                    return "permissionId_notFound";
                }
            }

            try {
                $user->vippermissions()->sync($permission_ids);
                return "success";
            } catch (\Exception $exception) {
                return "failed";
            }
        }
        return "notFound";
    }

    //check exist vip permission for user
    public function checkExistVipPermissionForUser($user_id, $permission_id)
    {
        return DB::table("vip_permission")->where(["user_id" => $user_id, "permission_id" => $permission_id])->exists();
    }


    //get all permission can assign to vip permission for user
    public function getAllPermissionCanAssignForUser($user_id)
    {
        $all_user_permission_ids = [];
        if (DB::table("role_user")->where("user_id", $user_id)->exists())
        {
            $user = $this->getUserById($user_id);
            foreach ($user->roles as $role)
            {
                foreach ($role->permissions as $permission)
                {
                    array_push($all_user_permission_ids, $permission->id);
                }
            }

            if ($user->vippermissions()->count() > 0) {
                $vipPermissions = $user->vippermissions()->get();
                foreach ($vipPermissions as $vipPermission) {
                    $userHavVipPermission[] = $vipPermission->id;
                }
            } else
                $userHavVipPermission = [];

            $all_user_permission_ids = array_merge($all_user_permission_ids, $userHavVipPermission);

            if(DB::table("permissions")->whereNotIn("id", array_unique($all_user_permission_ids))->count() > 0)
            {
                return [
                    "permission_ids" => DB::table("permissions")->whereNotIn("id", array_unique($all_user_permission_ids))->pluck("id")->toArray(),
                    "permissions" => DB::table("permissions")->whereNotIn("id", array_unique($all_user_permission_ids))->get()
                ];
            }
            else
            {
                return "permission-notFound";
            }
        }
        return DB::table("permissions")->get();
    }


    //check exists user by id
    public function checkExistUserById($user_id)
    {
        return DB::table("users")->where("id", $user_id)->exists();
    }

    //get user by user id
    public function getUserById($user_id)
    {
        if ($this->checkExistUserById($user_id)) {
            return User::withTrashed()->where("id", $user_id)->first();
        }
        return "notFound";
    }

}
