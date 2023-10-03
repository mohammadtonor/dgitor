<?php

namespace App\Repository\Contract\ACL\Permission;

use Illuminate\Http\Request;

interface PermissionService
{
    /** return view
     *
     * @return array
     */
    public function showPageInfo();

    /**
     * insert new Permission
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $name_en
     * @param $name_fa

     * @return array
     */
    public function insert($name_en, $name_fa);

    /**
     * select Permission by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function getPermissionById($id);

    /**
     * get all Permissions
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function getAllPermissions();

    /**
     * get role based on name
     *
     * @param $name_fa
     * @param $name_en
     * @return mixed [string|Model]
     */
    public function getRoleByInfo($name_fa,$name_en);

    /**
     * delete Permission based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function deletePermissionById($id);

    /**
     * update Role by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $name_fa
     * @param $name_en
     * @return string
     */
    public function update($id, $name_en, $name_fa);

    /**
     * check if Role given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistPermissionById($id);

    /**
     * check if any role by given names exists
     *
     * @param $id
     * @param $name_fa
     * @param $name_en
     * @return bool
     */
    public function checkExistPermissionByTitle($permission_id=null, $name_en=null, $name_fa=null);


}
