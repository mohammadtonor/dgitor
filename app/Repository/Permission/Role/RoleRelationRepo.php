<?php

namespace App\Repository\Permission\Role;

use Illuminate\Support\Facades\DB;

class RoleRelationRepo
{


    public function checkExistsRoleById($id)
    {
        return DB::table("roles")->where("id", $id)->exists();
    }

    ///////////////////////////////////////////permission


    public function assignPermissionToRole($permission_id, $role_id)
    {
        if ($this->checkExistsRoleById($role_id))
        {
            if (!DB::table("role_permission")->where(["role_id"=>$role_id,"permission_id"=>$permission_id])->exists())
            {
                return DB::table("role_permission")->insert(["role_id"=>$role_id,"permission_id"=>$permission_id]) ? "success" : "failed";
            }
            return  "exists";
        }
        return "notFound";
    }


    public function detachPermissionFromRole($permission_id, $role_id)
    {
        if ($this->checkExistsRoleById($role_id))
        {
            if (!DB::table("role_permission")->where(["role_id"=>$role_id,"permission_id"=>$permission_id])->exists())
            {
                return DB::table("role_permission")->where(["role_id"=>$role_id,"permission_id"=>$permission_id])->delete()>0 ? "success" : "failed";
            }
            return  "exists";
        }
        return "notFound";
    }

    public function syncPermissionsToRole($permission_ids, $role_id)
    {
        if ($this->checkExistsRoleById($role_id))
        {
            DB::beginTransaction();
            if (DB::table("role_permission")->where("role_id",$role_id)->exists())
            {
                if (DB::table("role_premission")->where("role_id",$role_id)->delete()>0)
                {
                    $insert_count=0;
                    foreach ($permission_ids as $permission_id)
                    {
                        if (DB::table("role_permission")->insert(["role_id"=>$role_id,"permission_id"=>$permission_id]))
                            $insert_count++;
                    }
                    if (count($permission_ids)==$insert_count)
                    {
                        DB::commit();
                        return "success";
                    }
                    DB::rollBack();
                    return "insert-count-failed";
                }
                DB::rollBack();
                return "delete-failed";
            }
            else
            {
                $insert_count=0;
                foreach ($permission_ids as $permission_id)
                {
                    if (DB::table("role_permission")->insert(["role_id"=>$role_id,"permission_id"=>$permission_id]))
                        $insert_count++;
                }
                if (count($permission_ids)==$insert_count)
                {
                    DB::commit();
                    return "success";
                }
                DB::rollBack();
                return "insert2-count-failed";
            }
        }
        return "notFound";
    }

    public function getAllPermissionsOfRole($role_id)
    {
        if ($this->checkExistsRoleById($role_id)) {
            return $this->getRoleById($role_id)->permissions()->count>0 ?
                $this->getRoleById($role_id)->permissions : "permission_notFound";
        }
        return "notFound";
    }



    ///////////////////////////////////////////user


    public function assignRoleToUser($user_id, $role_id)
    {
        if ($this->checkExistsRoleById($role_id))
        {
            if (!DB::table("role_user")->where(["role_id"=>$role_id,"user_id"=>$user_id])->exists())
            {
                return DB::table("role_user")->insert(["role_id"=>$role_id,"user_id"=>$user_id]) ? "success" : "failed";
            }
            return  "exists";
        }
        return "notFound";
    }


    public function detachRoleFromUser($user_id, $role_id)
    {
        if ($this->checkExistsRoleById($role_id))
        {
            if (!DB::table("role_user")->where(["role_id"=>$role_id,"user_id"=>$user_id])->exists())
            {
                return DB::table("role_user")->where(["role_id"=>$role_id,"user_id"=>$user_id])->delete()>0 ? "success" : "failed";
            }
            return  "exists";
        }
        return "notFound";
    }

    public function syncRolesToUser($role_ids, $user_id)
    {

        DB::beginTransaction();
        if (DB::table("role_user")->where("user_id",$user_id)->exists())
        {
            if (DB::table("role_user")->where("user_id",$user_id)->delete()>0)
            {
                $insert_count=0;
                foreach ($role_ids as $role_id)
                {
                    if (DB::table("role_user")->insert(["role_id"=>$role_id,"user_id"=>$user_id]))
                        $insert_count++;
                }
                if (count($role_ids)==$insert_count)
                {
                    DB::commit();
                    return "success";
                }
                DB::rollBack();
                return "insert-count-failed";
            }
            DB::rollBack();
            return "delete-failed";
        }
        else
        {
            $insert_count=0;
            foreach ($role_ids as $role_id)
            {
                if (DB::table("role_user")->insert(["role_id"=>$role_id,"user_id"=>$user_id]))
                    $insert_count++;
            }
            if (count($role_ids)==$insert_count)
            {
                DB::commit();
                return "success";
            }
            DB::rollBack();
            return "insert2-count-failed";
        }
    }

    public function getAllRoleOfuser($user_id)
    {
        if (DB::table("users")->where("id",$user_id)->exists())
        {
            return DB::table("role_user")->where("user_id",$user_id)->exists() ?
                DB::table("role_user")->where("user_id",$user_id)->get()  : "role-notFound";
        }
        return "notFound";
    }


    public function rolesCanAssignToUser($user_id)
    {
        if (DB::table("users")->where("id",$user_id)->exists())
        {
            return (DB::table("roles")->whereNotIn("id",DB::table("role_user")->where("user_id",$user_id)->pluck("role_id")->toArray())->exists()) ?
                DB::table("roles")->whereNotIn("id",DB::table("role_user")->where("user_id",$user_id)->pluck("role_id")->toArray())->get() : "role-notFound";
        }
        return "notFound";
    }



}
