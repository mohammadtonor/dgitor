<?php

namespace App\Repository\Contract\ACL\SpecPermission;

interface BlockPermissionService
{

    /**
     * return blade view
     *
     * @param $permission_id
     * @return mixed
     */
    public function showBlockPermissionPage($permission_id);

    /**
     * return all blockpermission that given User has.
     *
     * @param $user_id
     * @return mixed [string|Model[]]
     */
    public function getAllBlockPermissionOfUser($user_id);

    /**
     * attach given blockpermission to given user.
     *
     * @param $permission_id
     * @param $user_id
     * @return string
     */
    public function attachBlockPermissionToUser($user_id,$permission_id);

    /**
     * detach given blockpermission from given user.
     *
     * @param $permission_id
     * @param $user_id
     * @return string
     */
    public function detachBlockPermissionFormUser($user_id,$permission_id);

    /**
     * remove all blockpermissions from given user.
     *
     * @param $user_id
     * @return string
     */
    public function removeAllBlockPermissionFromUser($user_id);

    /**
     * check if blockpermissions For User given by ID exists or not
     *
     * @param $user_id
     * @param $permission_id
     * @return bool
     */
    public function checkExistBlockPermissionForUser($user_id,$permission_id);

    /**
     * returns all blockpermissions that given user does not have.
     *
     * @param $user_id
     * @return mixed [string|Model[]]
     */
    public function getAllBlockPermissionCanAssignForUser($user_id);

    /**
     * check if User given by ID exists or not
     *
     * @param $user_id
     * @return bool
     */
    public function checkExistUserById($user_id);

    /**
     * select User by Id
     * possible return values: "notFound", "Model"
     *
     * @param $user_id
     * @return mixed [string|Model]
     */
    public function getUserById($user_id);

}
