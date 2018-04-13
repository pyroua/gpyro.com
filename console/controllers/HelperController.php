<?php

namespace console\controllers;

use yii\rbac\DbManager;

class HelperController extends \yii\console\Controller
{

    /**
     * @param int $userId
     * @throws \Exception
     */
    public function actionMakeAdmin(int $userId)
    {
        try {
            $auth = new DbManager;
            $auth->init();
            $role = $auth->getRole('admin');
            $auth->assign($role, $userId);

            $this->stdout($this->ansiFormat("OK \n", \yii\helpers\Console::FG_GREEN));
        } catch (\Exception $e) {
            $this->stderr($this->ansiFormat('ERROR: ', \yii\helpers\Console::FG_RED));
            $this->stderr($e->getMessage() . "\n");
            $this->stderr($e->getTraceAsString());
        }
    }

}