<?php

namespace backend\controllers;

use backend\models\forms\CurrencyForm;
use common\models\Currency;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class CurrenciesController extends BaseController
{

    public $modelClass = Currency::class;

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
                    [
                        'actions' => ['index'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['currencies', 'addEditCurrency', 'deleteCurrency'],
                    ],
                    [
                        'actions' => ['create' , 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditCurrency'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deleteCurrency'],
                    ],
                    [    // all the action are accessible to admin
                        'allow' => true,
                        'roles' => ['admin'], //
                    ],
                ],
            ],
        ];
    }

    /**
     * @return CurrencyForm|string
     */
    public function actionCreate()
    {
        $formModel = new CurrencyForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof CurrencyForm) {
            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel
            ]);
        }

        return $formModel;
    }

    /**
     * @param CurrencyForm $formModel
     * @param bool $model
     * @return CurrencyForm|string
     */
    private function processData(CurrencyForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                if ($formModel->validate()) {
                    if (!$model) {
                        $model = new Currency();
                    }
                    $model->setAttributes($formModel->getAttributes());
                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('back', 'Success!'));
                        return $this->redirect(['currencies/index']);
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

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        /** @var Currency $currency */
        $currency = $this->getModel($id);
        $currency->deleteCurrency() ?
            $this->setFlash('success', Yii::t('back', 'Deleted')) :
            $this->setFlash('error', 'Cant delete category: some reason');

        return $this->redirect(['currencies/index']);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Currency::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return CurrencyForm|string
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        /** @var Currency $category */
        $category = $this->getModel($id);

        $formModel = new CurrencyForm();
        $formModel = $this->processData($formModel, $category);

        if ($formModel instanceof CurrencyForm) {
            // if not post set attrs from model
            $formModel->setAttributes($category->attributes);

            return $this->render('create', [
                'action' => 'update',
                'formModel' => $formModel
            ]);
        }

        return $formModel;
    }

}
