<?php

namespace App\Repository\Contract\ACL\City;

interface CityService
{
    /**
     *
     * @return array
     */
    public function showCityPageInfo($country_id, $ostan_id);

    /**
     * insert new City
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $title
     * @param $country_id
     * @param $ostan_id
     * @return array
     */
    public function insertCity($name, $country_id, $ostan_id);

    /**
     * select City by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function selectCityById($id);

    /**
     * get all Cities
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function selectAllCity();

    /**
     * update City by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $title
     * @param $country_id
     * @param $ostan_id
     * @return string
     */
    public function updateCity($id, $name, $country_id, $ostan_id);

    /**
     * delete City based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function deleteCity($id);

    /**
     * check if City given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistsCityById($id);

    /**
     * check if City given by ID exists or not
     *
     * @param $title
     * @return bool
     */
    public function checkExistsCityByTitle($city_id, $ostan_id, $country_id, $name);

    /**
     * @param $city_id
     * @return mixed [string|Model[]]
     */
    public function getOstanOfCity($city_id);

}
