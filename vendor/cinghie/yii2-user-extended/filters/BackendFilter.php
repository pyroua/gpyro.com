<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-user-extended
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-user-extended
 * @version 0.6.1
 */

namespace cinghie\userextended\filters;

use yii\base\ActionFilter;
use yii\web\NotFoundHttpException;

/**
 * BackendFilter is used to allow access only to admin and security controller in frontend when using Yii2-user with
 * Yii2 advanced template.
 */
class BackendFilter extends ActionFilter
{

    /**
     * @var array
     */
    public $controllers = ['recovery', 'registration'];

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     * @throws \yii\web\NotFoundHttpException
     */
    public function beforeAction($action)
    {
        if (in_array($action->controller->id, $this->controllers)) {
            throw new NotFoundHttpException('Not found');
        }

        return true;
    }

}
