<?php

namespace App\Repository\Contract\ACL\Ostan;

interface OstanService
{

    /**
     *
     * @return array
     */
    public function showOstanPageInfo($id);

    /**
     * insert new Ostan
     * sample of return value: ["status"=>"success", "result"=>$insertedRoleInstance]
     * sample of return value: ["status"=>"failed"]
     *
     * @param $title
     * @param $country_id
     * @return array
     */
    public function insertOstan($name, $country_id);

    /**
     * select Ostan by Id
     * possible return values: "notFound", "Model"
     *
     * @param $id
     * @return mixed [string|Model]
     */
    public function selectOstanById($id);

    /**
     * get all Ostans
     * possible return values: "notFound", "collection of models"
     *
     * @return mixed [string|Model[]]
     */
    public function selectAllOstan($country_id);

    /**
     * update Ostan by ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @param $title
     * @return string
     */
    public function updateOstan($id, $name, $country_id);

    /**
     * delete Ostan based on ID.
     * possible return values: "success", "failed"
     *
     * @param $id
     * @return string
     */
    public function deleteOstan($id);

    /**
     * check if Ostan given by ID exists or not
     *
     * @param $id
     * @return bool
     */
    public function checkExistsOstanById($id);

    /**
     * check if Ostan given by ID exists or not
     *
     * @param $title
     * @return bool
     */
    public function checkExistsOstanByTitle($ostan_id, $country_id, $name);

    /**
     * @param $ostan_id
     * @return mixed [string|Model[]]
     */
    public function getCitiesOfOstan($ostan_id);


}
