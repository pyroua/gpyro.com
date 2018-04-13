<?php

use yii\db\Migration;
use yii\rbac\DbManager;
use yii\base\InvalidConfigException;

/**
 * Class m180413_105132_measures_permissions
 */
class m180413_105132_measures_permissions extends Migration
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

        $measures = $auth->createPermission('measures');
        $measures->description = 'view measures page';
        $auth->add($measures);

        $addEditMeasure = $auth->createPermission('addEditMeasure');
        $auth->add($addEditMeasure);

        $deleteMeasure = $auth->createPermission('deleteMeasure');
        $auth->add($deleteMeasure);

        $auth->addChild($measures, $addEditMeasure);
        $auth->addChild($measures, $deleteMeasure);
        $auth->addChild($auth->getRole('admin'), $measures);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_105132_measures_permissions cannot be reverted.\n";

        return false;
    }
    */
}
