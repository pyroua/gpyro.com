<?php

namespace backend\components;

class User extends \yii\web\User
{
    public $loginUrl = ['main/login'];

    /**
     * @param string $role
     * @return bool
     */
    function hasRole(string $role)
    {
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        return array_key_exists($role, $roles);
    }
}