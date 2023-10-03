<?php

namespace App\Repository\Contract\ACL\Permission;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class PermissionImp implements PermissionService
{

    public function showPageInfo()
    {
        return view('permission.show');
    }

    public function insert($name_en,$name_fa)
    {
        try {
            // Use query builder to insert a new record into the "permissions" table
            DB::table('permissions')->insert([
                'name_en' => $name_en,
                'name_fa' => $name_fa,
            ]);
            return response()->json(['message' => 'Permission inserted successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to insert permission'], 500);
        }

    }

    public function getPermissionById($id)
    {
       return DB::table('permissions')
                       ->select('*')
                       ->where('id',$id)
                       ->get();
    }

    public function getAllPermissions()
    {
        return DB::table('permissions')->get();
    }

    public function getRoleByInfo($name_fa, $name_en)
    {
        return DB::table('permissions')->select('*')
            ->where('name_fa',$name_fa)
            ->orWhere('name_en',$name_en)
            ->get();
    }




    public function deletePermissionById($id)
    {
        DB::beginTransaction();

        try {
            // First, delete related records from the role_permissions table
            DB::table('role_permission')->where('permission_id', $id)->delete();

            // Then, delete the permission by its ID
            $deletedPermissionRows = DB::table('permissions')->where('id', $id)->delete();

            if ($deletedPermissionRows > 0) {
                DB::commit();
                return response()->json(['message' => 'Permission and related records deleted successfully']);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Permission not found or could not be deleted'], 404);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Failed to delete permission'], 500);
        }
    }


    public function update($id, $name_en, $name_fa)
    {
        DB::table('permissions')
            ->where('id', $id)
            ->update([
                'name_en' => $name_en,
                'name_fa' => $name_fa,
            ]);
        return "Record with ID $id updated successfully!";
    }

    public function checkExistPermissionById($id)
    {

        // Use query builder to check if the permission exists
        $permission = DB::table('permissions')->where('id', $id)->first();

        // If the permission is found (i.e., not null), it exists
        return !is_null($permission);

    }

    public function checkExistPermissionByTitle($permission_id = null, $name_en = null, $name_fa = null)
    {
        // Start building the query to check if the permission exists
        $query = DB::table('permissions');

        // Check if the permission ID is provided
        if ($permission_id !== null) {
            $query->where('id', $permission_id);
        }

        // Check if the name_en is provided
        if ($name_en !== null) {
            $query->where('name_en', $name_en);
        }

        // Check if the name_fa is provided
        if ($name_fa !== null) {
            $query->where('name_fa', $name_fa);
        }
        // Execute the query and check if the permission exists
        $permission = $query->first();

        // If the permission is found (i.e., not null), it exists
        return !is_null($permission);
    }

}
