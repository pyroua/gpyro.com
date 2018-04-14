<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use common\models\Item;
use backend\models\forms\ItemForm;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

class ItemsController extends BaseController
{

    public $modelClass = Item::class;

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
                    [    // all the action are accessible to admin
                        'allow' => true,
                        'roles' => ['admin'], //
                    ],
                ],
            ],
        ];
    }

    /**
     * @return ItemForm|string
     */
    public function actionCreate()
    {
        $formModel = new ItemForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof ItemForm) {
            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList()
            ]);
        }

        return $formModel;
    }


    /**
     * @param ItemForm $formModel
     * @param bool $model
     * @return ItemForm|string
     */
    private function processData(ItemForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                if ($formModel->validate()) {
                    if (!$model) {
                        $model = new Item();
                    }
                    $model->setAttributes($formModel->getAttributes());
                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['items/index']);
                    } else {
                        $this->setFlash('error', 'Cant save model: ' . print_r($model->getErrors(), 1));
                    }
                } else {
                    $this->setFlash('error', 'Cant validate form');
                }
            } catch (Exception $e) {
                // треба писати в логи
                //TODO: logger
            }
        }

        return $formModel;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
