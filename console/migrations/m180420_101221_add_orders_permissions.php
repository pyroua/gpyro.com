<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180420_101221_add_orders_permissions
 */
class m180420_101221_add_orders_permissions extends Migration
{
    /**
     * @return \yii\rbac\ManagerInterface
     * @throws InvalidConfigException
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
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $configOrder = $auth->createPermission('configOrder');
        $auth->add($configOrder);

        $auth->addChild($auth->getRole('admin'), $configOrder);
    }
}
