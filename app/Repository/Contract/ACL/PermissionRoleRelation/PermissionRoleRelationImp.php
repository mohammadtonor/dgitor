<?php

namespace App\Repository\Contract\ACL\PermissionRoleRelation;

use App\Models\Permission\Permission\Permission;
use App\Models\Permission\Role\Role;
use Illuminate\Support\Facades\DB;

class PermissionRoleRelationImp implements PermissionRoleRelationService
{

    public function showPagePermissionOfRole($role_id)
    {

        try {
            // Use query builder to retrieve permissions of the given role
            $permissions = DB::table('permissions')
                ->join('role_permission', 'permissions.id', '=', 'role_permission.permission_id')
                ->where('role_permission.role_id', $role_id)
                ->select('permissions.*')
                ->get();

            if ($permissions->isEmpty()) {
                return response()->json(['message' => 'No permissions found for the given role'], 404);
            }

            return response()->json(['permissions' => $permissions], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch permissions for the role'], 500);
        }
    }

    public function getAllPermissionsByRoleId($role_id)
    {
        return DB::table('permissions')
            ->join('role_permission', 'permissions.id', '=', 'role_permission.permission_id')
            ->where('role_permission.role_id', $role_id)
            ->select('permissions.*')
            ->get();
    }

//    public function getAllPermissionsRoleNotHave($role_id)
//    {
//
//        return DB::table('permissions')
//            ->leftJoin('role_permission', function ($join) use ($role_id) {
//                $join->on('permissions.id', '=', 'role_permission.permission_id')
//                    ->where('role_permission.role_id', '=', $role_id);
//            })
//            ->whereNull('role_permission.role_id')
//            ->select('permissions.*')
//            ->get();
//    }


    function getAllPermissionsRoleNotHave($role_id)
    {
        // Check if the role with the given role_id exists
        $roleExists = DB::table('roles')->where('id', $role_id)->exists();

        if (!$roleExists) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        try {
            // Get the IDs of permissions that the role already has
            $existingPermissionIds = DB::table('role_permission')
                ->where('role_id', $role_id)
                ->pluck('permission_id');

            // Get all permission IDs that the role does not have
            $permissionsNotHaveIds = DB::table('permissions')
                ->whereNotIn('id', $existingPermissionIds)
                ->pluck('id');

            // Get the corresponding permission records for the IDs that the role does not have
            $permissionsNotHave = DB::table('permissions')
                ->whereIn('id', $permissionsNotHaveIds)
                ->get();

            return response()->json($permissionsNotHave, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve permissions'], 500);
        }
    }


    function attachPermissionToRole($permission_id, $role_id)
    {
        // Check if the permission with the given permission_id exists in the permissions table
        $permissionExists = DB::table('permissions')->where('id', $permission_id)->exists();

        if (!$permissionExists) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        // Check if the relationship already exists in the role_permissions table
        $relationshipExists = DB::table('role_permission')
            ->where('permission_id', $permission_id)
            ->where('role_id', $role_id)
            ->exists();

        if ($relationshipExists) {
            return response()->json(['message' => 'Permission already attached to the role'], 400);
        }

        try {
            // Attach the permission to the role using the attach method
            DB::table('role_permission')->insert([
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ]);

            return response()->json(['message' => 'Permission attached to the role successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to attach permission to the role'], 500);
        }
    }




    function syncPermissionsToRole($permission_ids, $role_id)
    {
        try {
            // Start a database transaction
            DB::beginTransaction();

            // Verify that the role with the given role_id exists
            $role = DB::table('roles')->find($role_id);

            if (!$role) {
                DB::rollback();
                return response()->json(['message' => 'Role not found'], 404);
            }

            // Convert the permission_ids array to integers (for safety)
            $permission_ids = array_map('intval', $permission_ids);

            // Verify that all provided permission_ids exist in the permissions table
            $existingPermissions = DB::table('permissions')->whereIn('id', $permission_ids)->pluck('id');

            if (count($existingPermissions) !== count($permission_ids)) {
                DB::rollback();
                return response()->json(['message' => 'Invalid permission IDs provided'], 400);
            }

            // Get the existing permissions associated with the role
            $existingRolePermissions = DB::table('role_permission')
                ->where('role_id', $role_id)
                ->pluck('permission_id');

            // Determine the permissions to be attached (new permissions)
            $permissionsToAttach = array_diff($permission_ids, $existingRolePermissions->toArray());

            // Determine the permissions to be detached (permissions that need to be removed)
            $permissionsToDetach = array_diff($existingRolePermissions->toArray(), $permission_ids);

            // Detach the permissions that need to be removed
            if (!empty($permissionsToDetach)) {
                DB::table('role_permission')
                    ->where('role_id', $role_id)
                    ->whereIn('permission_id', $permissionsToDetach)
                    ->delete();
            }

            // Attach the new permissions
            if (!empty($permissionsToAttach)) {
                $permissionsToAttachData = array_map(function ($permission_id) use ($role_id) {
                    return ['role_id' => $role_id, 'permission_id' => $permission_id];
                }, $permissionsToAttach);

                DB::table('role_permission')->insert($permissionsToAttachData);
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Permissions synchronized successfully'], 200);
        } catch (\Exception $e) {
            // An exception occurred, rollback the transaction
            DB::rollback();
            return response()->json(['message' => 'Failed to synchronize permissions'], 500);
        }
    }






//    public function syncPermissionsToRole($permission_ids, $role_id)
//    {
////        // Find the role by its ID
////        $role = Role::find($role_id);
////
////        if (!$role) {
////            return response()->json(['message' => 'Role not found.'], 404);
////        }
////
////        // Get the permissions by their IDs
////        $permissions = Permission::find($permission_ids);
////
////        // Sync the permissions to the role
////        $role->permissions()->sync($permissions);
////
////        return response()->json(['message' => 'Permissions synced to role successfully.']);
//
//        try {
//            // Start a database transaction
//            DB::beginTransaction();
//
//            // Verify that the role with the given role_id exists
//            $role = DB::table('roles')->find($role_id);
//
//            if (!$role) {
//                DB::rollback();
//                return response()->json(['message' => 'Role not found'], 404);
//            }
//
//            // Convert the permission_ids array to integers (for safety)
//            $permission_ids = array_map('intval', $permission_ids);
//
//            // Verify that all provided permission_ids exist in the permissions table
//            $existingPermissions = DB::table('permissions')->whereIn('id', $permission_ids)->pluck('id');
//
//            if (count($existingPermissions) !== count($permission_ids)) {
//                DB::rollback();
//                return response()->json(['message' => 'Invalid permission IDs provided'], 400);
//            }
//
//            // Use the sync method to synchronize the permission IDs for the role
//            DB::table('role_permission')->where('role_id', $role_id)->sync($permission_ids);
//
//            // Commit the transaction
//            DB::commit();
//
//            return response()->json(['message' => 'Permissions synchronized successfully'], 200);
//        } catch (\Exception $e) {
//            // An exception occurred, rollback the transaction
//            DB::rollback();
//            return response()->json(['message' => 'Failed to synchronize permissions'], 500);
//        }
//    }

    public function detachPermissionFromRole($permission_id, $role_id)
    {
        // Find the role by its ID
        $role = Role::find($role_id);

        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        // Detach the specific permission from the role
        $role->permissions()->detach($permission_id);

        return response()->json(['message' => 'Permission detached from role successfully.']);
    }

    public function removeAllPermissionsFromRole($role_id)
    {
        // Find the role by its ID
        $role = Role::find($role_id);

        if (!$role) {
            return response()->json(['message' => 'Role not found.'], 404);
        }

        // Detach all permissions from the role
        $role->permissions()->detach();

        return response()->json(['message' => 'All permissions removed from role successfully.']);
    }

//    public function getAllRolesOfAPermission($permission_id)
//    {
//    // Use query builder to get all roles that have the given permission
//            return DB::table('roles')
//                ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
//                ->where('role_permission.permission_id', $permission_id)
//                ->select('roles.*')
//                ->get();
//
//    // $rolesWithPermission will now contain a collection of all roles that have the given permission
//    }



    function getAllRolesOfAPermission($permission_id)
    {
        // Check if the permission with the given permission_id exists
        $permissionExists = DB::table('permissions')->where('id', $permission_id)->exists();

        if (!$permissionExists) {
            return response()->json(['message' => 'Permission not found'], 404);
        }

        try {
            // Get the roles associated with the given permission_id
            $roles = DB::table('roles')
                ->join('role_permission', 'roles.id', '=', 'role_permission.role_id')
                ->where('role_permission.permission_id', $permission_id)
                ->select('roles.*')
                ->get();

            // Check if any roles are found
            if ($roles->isEmpty()) {
                return response()->json(['message' => 'No roles found for the given permission'], 404);
            }

            return response()->json($roles, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to retrieve roles'], 500);
        }
    }


}
