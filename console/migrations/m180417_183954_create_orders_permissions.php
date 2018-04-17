<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180417_183954_create_orders_permissions
 */
class m180417_183954_create_orders_permissions extends Migration
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

        $orders = $auth->createPermission('orders');
        $orders->description = 'view orders options page';
        $auth->add($orders);

        $deleteOrders = $auth->createPermission('deleteOrders');
        $auth->add($deleteOrders);

        $addEditOrders = $auth->createPermission('addEditOrders');
        $auth->add($addEditOrders);

        $auth->addChild($orders, $deleteOrders);
        $auth->addChild($orders, $addEditOrders);
        $auth->addChild($auth->getRole('admin'), $orders);
    }


}
