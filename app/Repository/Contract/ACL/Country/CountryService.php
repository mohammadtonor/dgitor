<?php

namespace App\Repository\Contract\ACL\Country;

interface CountryService
{
    /**
     *
     * @return array
     */
    public function showCountryPageInfo();

    /**
     * insert new Country
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $title
     * @return array
     */
    public function insertCountry($name);

    /**
     * select Country by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function selectCountryById($id);

    /**
     * get all Countries
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function selectAllCountry();

    /**
     * update Country by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $title
     * @return string
     */
    public function updateCountry($id, $name);

    /**
     * delete Country based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function deleteCountry($id);

    /**
     * check if Country given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistsCountryById($id);

    /**
     * check if Country given by ID exists or not
     *
     * @param $title
     * @return bool
     */
    public function checkExistsCountryByTitle($name);

}
