<?php

namespace common\services;

use Yii;
use yii\base\Behavior;
use yii\base\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\web\UnauthorizedHttpException;

class TokenAuthBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction($event)
    {
        Yii::$app->user->enableSession = false; // Disable session-based authentication
        $authenticator = new HttpBearerAuth();
        $authenticator->authenticate(Yii::$app->user, Yii::$app->request, Yii::$app->response);
        if (Yii::$app->user->isGuest) {
            throw new UnauthorizedHttpException('You are not authorized. Login for rent or buy.');
        }
    }
}