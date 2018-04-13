<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180413_092417_categories_permissions
 */
class m180413_092417_categories_permissions extends Migration
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
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $categories = $auth->createPermission('categories');
        $categories->description = 'view categories page';
        $auth->add($categories);

        $addEditCategory = $auth->createPermission('addEditCategory');
        $auth->add($addEditCategory);

        $deleteCategory = $auth->createPermission('deleteCategory');
        $auth->add($deleteCategory);

        $auth->addChild($categories, $addEditCategory);
        $auth->addChild($categories, $deleteCategory);
        $auth->addChild($auth->getRole('admin'), $categories);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_092417_categories_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_092417_categories_permissions cannot be reverted.\n";

        return false;
    }
    */
}
