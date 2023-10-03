<?php

namespace App\Repository\Contract\ACL\SpecPermission;

interface VipPermissionService
{

    /**
     * return blade view
     *
     * @param $permission_id
     * @return mixed
     */
    public function showVipPermissionPage($permission_id);

    /**
     * return all vippermissions that given User has.
     *
     * @param $user_id
     * @return mixed [string|Model[]]
     */
    public function getAllVipPermissionForUser($user_id);

    /**
     * attach given vippermission to given user.
     *
     * @param $permission_id
     * @param $user_id
     * @return string
     */
    public function attachVipPermissionToUser($user_id, $permission_id);

    /**
     * detach given vippermissin from given user.
     *
     * @param $permission_id
     * @param $user_id
     * @return string
     */
    public function detachVipPermissionFormUser($user_id, $permission_id);

    /**
     * remove all vippermissions from given user.
     *
     * @param $user_id
     * @return string
     */
    public function removeAllVipPermissionFormUser($user_id);

    /**
     * check if vippermission For User given by ID exists or not
     *
     * @param $user_id
     * @param $permission_id
     * @return bool
     */
    public function checkExistVipPermissionForUser($user_id, $permission_id);
    public function getAllPermissionCanAssignForUser($user_id);

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
