<?php

namespace backend\controllers;

use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\filters\VerbFilter;
use \yii\web\ForbiddenHttpException;
use cinghie\userextended\controllers\AdminController as Admin;

use cinghie\userextended\models\Profile;
use cinghie\userextended\models\User;
use yii\helpers\Url;

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

    /**
     * Updates an existing profile.
     *
     * @param int $id
     *
     * @return mixed
     * @throws \yii\base\Exception
     * @throws \yii\base\ExitException
     * @throws \yii\base\InvalidCallException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidParamException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionUpdateProfile($id)
    {
        /** @var User $user */
        Url::remember('', 'actions-redirect');
        $user    = $this->findModel($id);
        $profile = $user->profile;

        if ($profile === null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', $user);
        }

        // Load Old Image
        $oldImage = $profile->avatar;

        // Load avatarPath from Module Params
        $avatarPath = \Yii::getAlias(\Yii::$app->getModule('userextended')->avatarPath);

        // Create uploadAvatar Instance
        $image = $profile->uploadAvatar($avatarPath);

        // Profile Event
        $event = $this->getProfileEvent($profile);

        // Ajax Validation
        $this->performAjaxValidation($profile);

        $this->trigger(self::EVENT_BEFORE_PROFILE_UPDATE, $event);

        if ($profile->load(\Yii::$app->request->post())) {
            $profile->name = $profile->firstname . ' ' . $profile->lastname;

            if ($profile->save()) {
                // revert back if no valid file instance uploaded
                if ($image === false) {

                    $profile->avatar = $oldImage;

                } else {

                    // if is there an old image, delete it
                    if ($oldImage) {
                        $profile->deleteImage($oldImage);
                    }

                    // upload new avatar
                    $profile->avatar = $image->name;
                }

                \Yii::$app->getSession()->setFlash('success', \Yii::t('user', 'Profile details have been updated'));

                $this->trigger(self::EVENT_AFTER_PROFILE_UPDATE, $event);

                return $this->refresh();
            }
        }

        return $this->render('@backend/views/admin/_profile', [
            'user'    => $user,
            'profile' => $profile,
        ]);
    }
}
