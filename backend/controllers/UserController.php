<?php

namespace backend\controllers;

use common\models\User;
use common\services\TokenAuthBehavior;
use Yii;
use yii\web\Response;

class UserController extends ApiController
{
    public function beforeAction($action)
    {
        if ($action->id == 'signup'
            || $action->id == 'reset-password'
            || $action->id === 'change-password'
            || $action->id === 'approve-registration'
        ) {
            $this->enableCsrfValidation = false; // disable CSRF validation for this actions
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors["authenticator"] = [
            'class' => TokenAuthBehavior::class,
        ];
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => \yii\web\Response::FORMAT_JSON,
        ];
        return $behaviors;
    }

    public function actionLogin()
    {

    }
}