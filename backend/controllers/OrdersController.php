<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Order;
use common\models\ItemOptionValue;
use backend\models\forms\ItemForm;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

class OrdersController extends BaseController
{

    public $modelClass = Order::class;

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function () {
                    throw new ForbiddenHttpException('Access denied');
                },
                'rules' => [
//                    [
//                        'actions' => ['index'], // these action are accessible
//                        'allow' => true,
//                        'permissions' => ['items', 'addEditItems', 'deleteItems'],
//                    ],
//                    [
//                        'actions' => ['create', 'update'], // these action are accessible
//                        'allow' => true,
//                        'permissions' => ['addEditItems'],
//                    ],
//                    [
//                        'actions' => ['delete'], // these action are accessible
//                        'allow' => true,
//                        'permissions' => ['deleteItems'],
//                    ],
                    [    // all the action are accessible to admin
                        'allow' => true,
                        'roles' => ['admin'], //
                    ],
                ],
            ],
//            [
//                'class' => AjaxFilter::class,
//                'only' => ['get-options']
//            ],
        ];
    }


    public function actionIndex()
    {


        return $this->render('index');
    }



}
