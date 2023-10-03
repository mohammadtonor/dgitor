<?php

namespace App\Repository\Contract\ACL\PermissionRoleRelation;

interface PermissionRoleRelationService
{
    /**
     * return blade view
     *
     * @param $role_id
     * @return mixed
     */
    public function showPagePermissionOfRole($role_id);


    /**
     * return all permissions that given role has.
     * possible return values: "role_notFound", "permisson_notFound", "collection of permissions"
     *
     * @param $role_id
     * @return mixed [string|Model[]]
     */
    public function getAllPermissionsByRoleId($role_id);


    /**
     * returns all permissions that given role does not have.
     * possible return values: "role_notFound", "permission_notFound", "collection of permissions"
     *
     * @param $role_id
     * @return mixed [string|Model[]]
     */
    public function getAllPermissionsRoleNotHave($role_id);


    /**
     * attach given permission to given role.
     * possible return values: "role-notFound", "permissionrole-exists", "success", "failed"
     *
     * @param $permission_id
     * @param $role_id
     * @return string
     */
    public function attachPermissionToRole($permission_id,$role_id);


    /**
     * sync permissions to given role
     * possible return values: "role_notFound", "permission_notFound", "success", "failed"
     *
     * @param $permission_ids
     * @param $role_id
     * @return string
     */
    public function syncPermissionsToRole($permission_ids,$role_id);


    /**
     * detach given permissin from given role.
     * possible return values: "role_notFound", "permissionrole-notexists", "success", "failed"
     *
     * @param $permission_id
     * @param $role_id
     * @return string
     */
    public function detachPermissionFromRole($permission_id,$role_id);


    /**
     * remove all permissions from given role.
     * possible return values: "role_notFound", "permission-notFound", "success", "failed"
     *
     * @param $role_id
     * @return string
     */
    public function removeAllPermissionsFromRole($role_id);

    /**
     * @param $permission_id
     * @return mixed
     */
    public function getAllRolesOfAPermission($permission_id);

}
