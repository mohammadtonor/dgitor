<?php

namespace App\Repository\Contract\ACL\RoleUserRelation;

interface RoleUserRelationService
{
    /**
     * return blade view
     *
     * @param $user_id
     * @return array
     */
    public function showPageRoleOfuser($user_id);


    /**
     * returns all groups of given user
     * possible return values: "user-notFound", "role-notFound", "collection of roles"
     *
     * @param $user_id
     * @return mixed [string|Model[]]
     */
    public function getAllRolesByUserId($user_id);


    /**
     * returns all roles which user does not have
     *
     * @param $user_id
     * @return mixed
     */
    public function getAllRolesUserNotHave($user_id);


    /**
     * attach given Role to given user. possible return values: "success", "failed", "duplicate"
     *
     * @param $role_id
     * @param $user_id
     * @return string
     */
    public function assignRoleToUser($role_id,$user_id);


    /**
     * sync Roles to user. possible return values: "role-notFound", "user-notFound", "success", "failed"
     *
     * @param $user_id
     * @param $role_ids
     * @return string
     */
    public function syncRolesToUser($role_ids,$user_id);


    /**
     * detach role from user.
     * possible return value: "success", "failed"
     *
     * @param $role_id
     * @param $user_id
     * @return mixed
     */
    public function detachRoleFromUser($role_id,$user_id);

    /**
     * remove all roles of given user
     *
     * @param $user_id
     * @return mixed
     */
    public function removeAllRolesOfUser($user_id);

}
