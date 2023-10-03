<?php

namespace App\Repository\Contract\ACL\FinalPermissionUtils;

interface FinalPermissionUtilsService
{
    /**
     * return final permissions that given user has.
     *
     * @param $user_id
     * @return mixed [string|Model[]]
     */
    public static function getFinalPermissionIdsOfUser($user_id);

}
