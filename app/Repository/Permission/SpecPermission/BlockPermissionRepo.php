<?php

namespace App\Repository\Permission\SpecPermission;

use App\Models\Permission\Permission\Permission;
use App\Models\User;
use App\Repository\Contract\ACL\SpecPermission\BlockPermissionService;
use Illuminate\Support\Facades\DB;

class BlockPermissionRepo
{

    ////////////////////////////////////////page

    public function showBlockPermissionPage($user_id)
    {
        $pageInfo = [
            "count" => 0,
            "permissions" => null,
            "canpermissions" => null
        ];
        if (DB::table("block_permission")->where("user_id", $user_id)->exists())
        {
            $pageInfo["count"] = DB::table("block_permission")->where("user_id", $user_id)->count();
            $pageInfo["permissions"] = $this->getAllBlockPermissionOfUser($user_id);
            $pageInfo["canpermissions"] = $this->getAllBlockPermissionCanAssignForUser($user_id);
        }
        else
        {
            $pageInfo["canpermissions"] = $this->getAllBlockPermissionCanAssignForUser($user_id);
        }
        return $pageInfo;
    }

    ////////////////////////////////////////crud

    //get all block permission of user
    public function getAllBlockPermissionOfUser($user_id)
    {
        if ($this->checkExistUserById($user_id))
        {
            if (DB::table("block_permission")->where("user_id", $user_id)->exists())
            {
                return DB::table("permissions")->whereIn("id",
                    DB::table("block_permission")->where("user_id", $user_id)->pluck("permission_id")->toArray())->get();
            }
            return "permission-notFound";
        }
        return "user-notFound";
    }


    //attach block permission to user
    public function attachBlockPermissionToUser($user_id, $permission_id)
    {
        if (!$this->checkExistBlockPermissionForUser($user_id, $permission_id))
        {
            return (DB::table("block_permission")->insert(["user_id" => $user_id, "permission_id" => $permission_id]) > 0) ? "success" : "failed";
        }
        return "permission-exists";
    }


    public function syncBlockPermissionToUser($user_id, $permission_ids)
    {
        if ($this->checkExistUserById($user_id))
        {
            $user = $this->getUserById($user_id);
            $canAssignBlockPermissionForUser = $this->getAllBlockPermissionCanAssignForUser($user_id);

            foreach ($permission_ids as $permission_id)
            {
                if (!in_array($permission_id, $canAssignBlockPermissionForUser["permission_ids"]))
                {
                    return "permissionId_notFound";
                }
            }

            try {
                $user->blockpermissions()->sync($permission_ids);
                return "success";
            }
            catch (\Exception $exception)
            {
                return "failed";
            }
        }
        return "user_notFound";
    }

    //remove block permission from user
    public function detachBlockPermissionFromUser($user_id, $permission_id)
    {
        if ($this->checkExistBlockPermissionForUser($user_id, $permission_id))
        {
            return (DB::table("block_permission")->where(["user_id" => $user_id, "permission_id" => $permission_id])->delete() > 0)
                ? "success" : "failed";
        }
        return "permission-not-exists";
    }


    //remove all block permission from user
    public function removeAllBlockPermissionFromUser($user_id)
    {
        if (DB::table("block_permission")->where("user_id", $user_id)->exists())
        {
            return (DB::table("block_permission")->where("user_id", $user_id)->delete() > 0) ? "success" : "failed";
        }
        return "notFound";
    }

    //check exist block permission for user
    public function checkExistBlockPermissionForUser($user_id, $permission_id)
    {
        return DB::table("block_permission")->where(["user_id" => $user_id, "permission_id" => $permission_id])->exists();
    }


    //get all permission can assign to block permission for user
    public function getAllBlockPermissionCanAssignForUser($user_id)
    {
        $all_user_permission_ids = [];
        if (DB::table("role_user")->where("user_id", $user_id)->exists())
        {
            $user = $this->getUserById($user_id);
            foreach ($user->roles as $role) {
                foreach ($role->permissions as $permission) {
                    array_push($all_user_permission_ids, $permission->id);
                }
            }

            if(DB::table("permissions")->whereIn("id", array_unique($all_user_permission_ids))->count() > 0)
            {
                return [
                    "permission_ids" => DB::table("permissions")->whereIn("id", array_unique($all_user_permission_ids))->pluck("id")->toArray(),
                    "permissions" => DB::table("permissions")->whereIn("id", array_unique($all_user_permission_ids))->get()
                ];
            }
            else
            {
                "permission-notFound";
            }

        }
        return "permission-notFound";
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
            return User::where("id", $user_id)->first();
        }
        return "notFound";
    }
}
