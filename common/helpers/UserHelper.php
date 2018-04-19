<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 31.07.17
 * Time: 11:12
 */

namespace common\helpers;


class UserHelper
{

    /**
     * @param string $role
     * @return bool
     */
    function hasRole(string $role)
    {
        $roles = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
        return array_key_exists($role, $roles);
    }
}