<?php

namespace backend\controllers;

use Yii;
use common\models\Category;
use backend\models\forms\CategoryForm;
use backend\helpers\CategoryHelper;
use yii\base\Exception;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class CategoriesController extends BaseController
{
    public $modelClass = Category::class;

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
                        'permissions' => ['categories', 'addEditCategory', 'deleteCategory'],
                    ],
                    [
                        'actions' => ['create' , 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditCategory'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deleteCategory'],
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
     * @param $id
     * @return CategoryForm|string
     * @throws \Exception
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



}
