<?php
namespace backend\models;

use Yii;
use cinghie\userextended\models\User as BaseUser;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends BaseUser
{
    /**
     * @return bool Whether the user is an admin or not.
     */
    public function getIsAdmin()
    {
        return array_key_exists(
            'admin',
            \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id)
        );
    }
}
