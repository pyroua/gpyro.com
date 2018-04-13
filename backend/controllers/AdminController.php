<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use \yii\web\ForbiddenHttpException;
use cinghie\userextended\controllers\AdminController as Admin;

class AdminController extends Admin
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRule::class,
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Access denied');
                },
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['switch'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'permissions' => ['manageUsers'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
