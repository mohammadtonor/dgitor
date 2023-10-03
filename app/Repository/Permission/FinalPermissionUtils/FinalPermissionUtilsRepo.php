<?php

namespace App\Repository\Permission\FinalPermissionUtils;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class FinalPermissionUtilsRepo
{

    public static function getFinalPermissionIdsOfUser($user_id)
    {
        $all_user_permission_ids=[];

        if (DB::table("role_user")->where("user_id",$user_id)->exists())
        {
            $user=User::where("id",$user_id)->first();
            foreach ($user->roles as $role)
            {
                foreach ($role->permissions as $permission)
                {
                    array_push($all_user_permission_ids,$permission->id);
                }
            }
        }

        if (DB::table("vip_permission")->where("user_id",$user_id)->exists())
        {
            $all_user_permission_ids=array_merge($all_user_permission_ids,
                DB::table("vip_permission")->where("user_id",$user_id)->pluck("permission_id")->toArray());
        }

        if (DB::table("block_permission")->where("user_id",$user_id)->exists())
        {
            $all_user_permission_ids=array_diff($all_user_permission_ids,
                DB::table("block_permission")->where("user_id",$user_id)->pluck("permission_id")->toArray());
        }

        return (count(array_unique($all_user_permission_ids))>0) ?
            DB::table("permissions")->whereIn("id",$all_user_permission_ids)->get() : "permission-notFound";
    }

}
