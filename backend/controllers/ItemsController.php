<?php

namespace backend\controllers;

use backend\models\forms\ItemSearchForm;
use common\models\User;
use Yii;
use common\models\Category;
use common\models\Item;
use backend\models\forms\ItemForm;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\filters\AjaxFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;


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
                    [
                        'actions' => ['index'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['items', 'addEditItems', 'deleteItems'],
                    ],
                    [
                        'actions' => ['create', 'update'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['addEditItems'],
                    ],
                    [
                        'actions' => ['delete'], // these action are accessible
                        'allow' => true,
                        'permissions' => ['deleteItems'],
                    ],
                    [    // all the action are accessible to admin
                        'allow' => true,
                        'roles' => ['admin'], //
                    ],
                ],
            ],
            [
                'class' => AjaxFilter::class,
                'only' => ['get-options']
            ],
        ];
    }

    /**
     * @param int|null $id
     * @return ItemForm|string|\yii\web\Response
     * @throws \Exception
     */
    public function actionCreate(int $id = null)
    {
        $formModel = new ItemForm();
        $itemModel = new Item();
        $formModel = $this->processData($formModel, $itemModel);

        if ($formModel instanceof ItemForm) {

            if ($id !== null) {
                $category = Category::findOne(['id' => $id]);
                if ($category) {
                    $formModel->setAttributes([
                        'category_id' => $category->id
                    ]);
                }
            }

            return $this->render('create', [
                'category' => !empty($category) ? $category : null,
                'action' => 'create',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList(),
            ]);
        }

        return $formModel;
    }

    public function actionUpdate(int $id)
    {
        /** @var Item $model */
        $model = $this->getModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        $formModel = new ItemForm(['scenario' => ItemForm::SCENARIO_UPDATE]);
        $formModel = $this->processData($formModel, $model);

        if ($formModel instanceof ItemForm) {
            // if not post set attrs from model
            $formModel->setAttributes($model->getAttributes());

            return $this->render('create', [
                'item' => $model,
                'action' => 'update',
                'formModel' => $formModel,
                'categoriesList' => Category::getArrayList(),
            ]);
        }

        return $formModel;
    }

    /**
     * @param ItemForm $formModel
     * @param Item $model
     * @return ItemForm|\yii\web\Response
     * @throws \Exception
     */
    private function processData(ItemForm $formModel, $model)
    {
        if (Yii::$app->request->post()) {
            try {
                $formModel->load(Yii::$app->request->post());
                $formModel->file = UploadedFile::getInstance($formModel, 'file');

                if ($formModel->validate()) {

                    $model->setAttributes($formModel->getAttributes());
                    $model->setItemOptions($formModel->getItemOptions());

                    if ($formModel->file) {
                        $model->setFile($formModel->file);
                    }

                    if ($model->save()) {
                        $this->setFlash('success', Yii::t('app', 'Success!'));
                        return $this->redirect(['items/index/' . $model->category_id]);
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
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearchForm();

        if (Yii::$app->request->post()) {
            $searchModel->load(Yii::$app->request->post());
        }

        return $this->render('index', [
            'categoriesList' => Category::getArrayList(),
            'manufacturerList' => User::getArrayListOfManufacturer(),
            'searchModel' => $searchModel,
            'dataProvider' => new ActiveDataProvider([
                'query' => Item::search($searchModel->attributes),
                'pagination' => [
                    'pageSize' => 50,
                ],
            ])
        ]);
    }

    /**
     * @param int $id
     * @return string
     */
    public function actionGetOptions(int $id)
    {
        $category = Category::findOne(['id' => $id]);

        if (empty($category)) {
            return $this->asJson([]);
        }

        foreach ($category->itemOptions as $itemOption) {
            // сетим категорію, через яку потім пролізем в таблиц item_option_category
            // щоб взяти звідти занчення поля required
            $itemOption->setCategoryId($id);
        }

        return $this->renderAjax('_ajax_item_options', ['options' => $category->itemOptions]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        /** @var Item $model */
        $model = $this->getModel($id);
        $categoryId = $model->category_id;

        $model->deleteItem() ?
            $this->setFlash('success', Yii::t('app', 'Deleted')) :
            $this->setFlash('error', 'Cant delete item');

        return $this->redirect(['items/index/' . $categoryId]);
    }

}
