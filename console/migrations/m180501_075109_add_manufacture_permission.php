<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180501_075109_add_manufacture_permission
 */
class m180501_075109_add_manufacture_permission extends Migration
{

    /**
     * @throws yii\base\InvalidConfigException
     * @return DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }

        return $authManager;
    }

    /**
     * @return bool|void
     * @throws InvalidConfigException
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $manufacture = $auth->createRole('manufacturer');
        $manufacture->description = 'Manufacturer role';
        $auth->add($manufacture);

        $auth->addChild($auth->getRole('admin'), $manufacture);
    }


}


