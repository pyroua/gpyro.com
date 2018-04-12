<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use backend\models\forms\CategoryForm;
use backend\helpers\CategoryHelper;
use yii\base\Exception;
use yii\web\NotFoundHttpException;

class CategoriesController extends BaseController
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        $categories = Category::find()->all();

        return $this->render('index', [
            'catTree' => CategoryHelper::buildCatTree($categories)
        ]);
    }

    /**
     * @return CategoryForm|string
     */
    public function actionCreate()
    {
        $formModel = new CategoryForm();
        $formModel = $this->processData($formModel);

        if ($formModel instanceof CategoryForm) {
            return $this->render('create', [
                'action' => 'create',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList()
            ]);
        }

        return $formModel;
    }

    /**
     * @param int $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    private function getModel($id)
    {
        $category = Category::getById($id);
        if (empty($category)) {
            throw new NotFoundHttpException('Category not found');
        }

        return $category;
    }

    /**
     * @param int $id
     * @return CategoryForm|string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        /** @var Category $category */
        $category = $this->getModel($id);

        $formModel = new CategoryForm();
        $formModel = $this->processData($formModel, $category);

        if ($formModel instanceof CategoryForm) {
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

    /**
     * @param CategoryForm $formModel
     * @param bool $model
     * @return CategoryForm|string
     */
    private function processData(CategoryForm $formModel, $model = false)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                if ($formModel->validate()) {
                    if (!$model) {
                        $model = new Category();
                    }
                    $model->setAttributes($formModel->getAttributes());
                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['categories/index']);
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
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        /** @var Category $category */
        $category = $this->getModel($id);
        $category->deleteCategory() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete category: some reason');

        return $this->redirect(['categories/index']);
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['categories']
                    ],
                ],
            ],
        ];
    }

}
