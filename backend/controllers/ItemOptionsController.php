<?php

namespace backend\controllers;

use Yii;
use backend\models\forms\ItemOptionForm;
use common\models\ItemOption;
use common\models\Category;
use common\models\Measure;
use yii\data\ActiveDataProvider;

class ItemOptionsController extends BaseController
{
    public $modelClass = ItemOption::class;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ItemOption::find(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * @return ItemOptionForm|string
     */
    public function actionCreate()
    {
        $formModel = new ItemOptionForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof ItemOptionForm) {
            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList(),
                'measuresList' => Measure::getArrayList()
            ]);
        }

        return $formModel;
    }

    /**
     * @param $id
     * @return ItemOptionForm|string
     * @throws \Exception
     */
    public function actionUpdate($id)
    {
        /** @var Category $model */
        $model = $this->getModel($id);

        $formModel = new ItemOptionForm();
        $formModel = $this->processData($formModel, $model);

        if ($formModel instanceof ItemOptionForm) {
            // if not post set attrs from model
            $formModel->setAttributes($model->getAttributes());
            // set array of categories id
            $formModel->setAttributes(['categories' => $model->getCategoriesAsArray()]);

            return $this->render('create', [
                'action' => 'update',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList(),
                'measuresList' => Measure::getArrayList()
            ]);
        }

        return $formModel;
    }

    /**
     * @param ItemOptionForm $formModel
     * @param bool $model
     * @return CategoryForm|string
     */
    private function processData(ItemOptionForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                if ($formModel->validate()) {
                    if (!$model) {
                        $model = new ItemOption();
                    }
                    $model->setAttributes($formModel->getAttributes());
                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['item-options/index']);
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

    public function actionDelete($id)
    {
        /** @var ItemOption $category */
        $model = $this->getModel($id);
        $model->deleteItemOption() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete category: some reason');

        return $this->redirect(['item-options/index']);
    }

}
