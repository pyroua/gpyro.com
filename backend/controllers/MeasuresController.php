<?php

namespace backend\controllers;

use backend\models\forms\MeasureForm;
use common\models\Category;
use common\models\Measure;
use Yii;
use yii\data\ActiveDataProvider;

class MeasuresController extends BaseController
{
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
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
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

    private function getModel($id)
    {
        $measure = Measure::getById($id);
        if (empty($measure)) {
            throw new NotFoundHttpException('Category not found');
        }

        return $measure;
    }

}
