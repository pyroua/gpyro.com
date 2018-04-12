<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use cinghie\userextended\controllers\AdminController as Admin;

class AdminController extends Admin
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (!\Yii::$app->user->can('manageUsers')) {
                throw new \yii\web\ForbiddenHttpException('Доступ закрыт.');
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['switch'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        //'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'activemultiple' => ['post'],
                    'deactivemultiple' => ['post'],
                    'delete' => ['post'],
                    'deletemultiple' => ['post'],
                    'confirm' => ['post'],
                    'resend-password' => ['post'],
                    'block' => ['post'],
                    'switch' => ['post'],
                ],
            ]
        ];
    }
}
