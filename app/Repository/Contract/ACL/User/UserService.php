<?php

namespace App\Repository\Contract\ACL\User;

interface UserService
{
    /*
     * return blade view
     *
     * @param $user_id
     * @return array
     */
    public function showUserPageInfo();

    /**
     * insert new User
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $name
     * @param $family
     * @param $ncode
     * @param $gender
     * @param $birthday
     * @param $username
     * @param $password
     * @param $email
     * @param $pic_file
     * @param $desc
     * @param $email_verified_at
     * @param $mobile
     * @param $mobile_verified
     * @param $mobile_verification_code
     * @param $mobile_verification_time
     * @param $lang
     * @param $is_geniue
     * @param $personnel_code
     * @param $is_customer
     * @param $ostan_id
     * @param $country_id
     * @param $register_customer_id
     * @param $city_id
     * @param $title
     * @param $postal_code
     * @param $address
     * @return array
     */
    public function insertUser($name, $family, $ncode, $gender, $birthday, $username, $password,
                               $email, $pic_file, $desc, $email_verified_at, $mobile, $mobile_verified,
                               $mobile_verification_code, $mobile_verification_time,
                               $lang, $is_geniue, $personnel_code, $is_customer,
                               $ostan_id, $country_id, $register_customer_id,$city_id,
                               $title, $postal_code, $address);

    /**
     * select User by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function selectUserById($id);

    /**
     * get all Users
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function selectAllUsers();

    /**
     * get User based on name
     *
     * @param $name
     * @return mixed [string|Model]
     */
    public function getUserByInfo($name);

    /**
     * update User by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $name
     * @param $family
     * @param $ncode
     * @param $gender
     * @param $birthday
     * @param $username
     * @param $password
     * @param $email
     * @param $pic_file
     * @param $desc
     * @param $email_verified_at
     * @param $mobile
     * @param $mobile_verified
     * @param $mobile_verification_code
     * @param $mobile_verification_time
     * @param $lang
     * @param $is_geniue
     * @param $personnel_code
     * @param $is_customer
     * @param $ostan_id
     * @param $country_id
     * @param $register_customer_id
     * @param $city_id
     * @param $title
     * @param $postal_code
     * @param $address
     * @return string
     */
    public function updateUserById($id, $name, $family, $ncode, $gender, $birthday, $username, $password,
                                        $email, $pic_file, $desc, $email_verified_at, $mobile, $mobile_verified,
                                        $mobile_verification_code, $mobile_verification_time,
                                        $lang, $is_geniue, $personnel_code, $is_customer,
                                        $ostan_id, $country_id, $register_customer_id,$city_id,
                                        $title, $postal_code, $address);

    /**
     * delete User based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function deleteUserById($id);

    /**
     * check if User given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistsUserById($id);

    /**
     * @param $id
     * @return mixed [string|Model[]]
     */
    public function getAllRolesWithUser($user_id);



}
