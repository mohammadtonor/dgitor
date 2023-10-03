<?php

namespace App\Repository\Contract\ACL\Role;

interface RoleService
{
    /**
     *
     * @return array
     */
    public function showPageInfo();


    /**
     * insert new Role
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $name_fa
     * @param $name_en
     * @return array
     */
    public function insert($name_fa,$name_en);


    /**
     * select Role by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function getRoleById($id);


    /**
     * get all Roles
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function getAllRoles();


    /**
     * get role based on name
     *
     * @param $name_fa
     * @param $name_en
     * @return mixed [string|Model]
     */
    public function getRoleByInfo($name_fa,$name_en);


    /**
     * delete Role based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function delete($id);


    /**
     * delete multiple Roles based on given IDs.
     * possible return values: "success","failed"
     *
     * @param $ids
     * @return string
     */
    public function deleteByIds($ids);


    /**
     * update Role by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $name_fa
     * @param $name_en
     * @return string
     */
    public function update($id,$name_fa,$name_en);


    /**
     * check if Role given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistRoleById($id);


    /**
     * check if any role by given names exists
     *
     * @param $id
     * @param $name_fa
     * @param $name_en
     * @return bool
     */
    public function checkExistsRoleByName($id=null,$name_fa=null,$name_en=null);


    /**
     * attach given permission to given Role.
     * possible return values: "success", "failed", "duplicate"
     *
     * @param $permission_id
     * @param $role_id
     * @return string
     */
    public function assignPermissionToRole($permission_id,$role_id);


    /**
     * sync permissions to Role.
     * possible return values: "role-notFound", "permission-notFound", "success", "failed"
     *
     * @param $permission_ids
     * @param $role_id
     * @return string
     */
    public function syncPermissionsToRole($permission_ids,$role_id);


    /**
     * @param $id
     * @return mixed [string|Model[]]
     */
    public function getAllPermissionsOfRole($id);


}
