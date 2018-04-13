<?php

namespace backend\controllers;

use backend\models\forms\MeasureForm;
use common\models\Category;
use common\models\Measure;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class MeasuresController extends BaseController
{

    public $modelClass = Measure::class;

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
                        'permissions' => ['measures', 'addEditMeasure', 'deleteMeasure'],
                    ],
                    [
                        'actions' => ['create' , 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditMeasure'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deleteMeasure'],
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
     * @return MeasureForm|string
     */
    public function actionCreate()
    {
        $formModel = new MeasureForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof MeasureForm) {
            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList()
            ]);
        }

        return $formModel;
    }

    /**
     * @param MeasureForm $formModel
     * @param bool $model
     * @return MeasureForm|string
     */
    private function processData(MeasureForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                if ($formModel->validate()) {
                    if (!$model) {
                        $model = new Measure();
                    }
                    $model->setAttributes($formModel->getAttributes());
                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['measures/index']);
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
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        /** @var Category $measure */
        $measure = $this->getModel($id);
        $measure->deleteMeasure() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete category: some reason');

        return $this->redirect(['measures/index']);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Measure::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @param $id
     * @return MeasureForm|string
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        /** @var Measure $category */
        $category = $this->getModel($id);

        $formModel = new MeasureForm();
        $formModel = $this->processData($formModel, $category);

        if ($formModel instanceof MeasureForm) {
            // if not post set attrs from model
            $formModel->setAttributes($category->attributes);

            return $this->render('create', [
                'action' => 'update',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList()
            ]);
        }

        return $formModel;
    }

}
