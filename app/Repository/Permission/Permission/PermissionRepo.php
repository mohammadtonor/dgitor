<?php

namespace App\Repository\Permission\Permission;

use App\Models\Permission\Permission\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepo
{

    /////////////////////////////page

    public function showPageInfo()
    {
        $pageInfo=[
            "count"=>0,
            "permissions"=>null
        ];
        if (DB::table("permissions")->count()>0)
        {
            $pageInfo["count"]=DB::table("permissions")->count();
            $pageInfo["permissions"]=Permission::all();
        }
        return $pageInfo;
    }


    /////////////////////////////crud

//    public function insert($name_en,$name_fa)
//    {
//        if (!$this->checkExistPermissionByTitle(null,$name_en,$name_fa))
//        {
//            $permission=new Permission();
//            $permission->name_en=$name_en;
//            $permission->name_fa=$name_fa;
//            return ($permission->save())?
//                ["status"=>"ok","result"=>$permission]:["status"=>"failed"];
//        }
//        return ["status"=>"duplicate"];
//    }

    public function getPermissionById($id)
    {
        if ($this->checkExistPermissioById($id))
            return Permission::withTrashed()->where("id",$id)->first();
        return "notFound";
    }

    public function getAllPermissions()
    {
        $this->showPageInfo();
    }

//    public function deletePermissionById($id)
//    {
//        if ($this->checkExistPermissioById($id))
//        {
//            return (Permission::where("id",$id)->delete()) ? "success" :"failed";
//        }
//        return "notFound";
//    }

    public function update($id,$name_en,$name_fa)
    {
        if ($this->checkExistPermissioById($id))
        {
            if (!$this->checkExistPermissionByTitle($id,$name_en,$name_fa))
            {
                $permission=$this->getPermissionById($id);
                if ($name_fa!=null)$permission->name_fa=$name_fa;
                if ($name_en!=null)$permission->name_en=$name_en;
                return ($permission->save()) ? "success" : "failed";
            }
            return "duplicate";
        }
        return "notFound";
    }

    /////////////////////////////operation

    public function checkExistPermissioById($id)
    {
        return DB::table("permissions")->where("id",$id)->exists();
    }

    public function checkExistPermissionByTitle($permission_id,$name_en=null,$name_fa=null)
    {
        if ($name_fa==null && $name_en==null) return true;

        $permissions=DB::table("permissions");
        if ($permission_id!=null) $permissions->where("id","<>",$permission_id);
        if ($name_en!=null) $permissions->where("name_en",$name_en);
        if ($name_fa!=null) $permissions->where("name_fa",$name_fa);
        return $permissions->exists();
    }

    /////////////////////////////relation


}
