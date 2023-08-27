<?php

namespace backend\controllers;


use Yii;
use yii\filters\Cors;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

class ApiController extends Controller
{
    public function beforeAction($action)
    {
        $origin = \Yii::$app->request->getOrigin();

        Yii::$app->response->headers->set('Access-Control-Allow-Origin', $origin);
        Yii::$app->response->headers->set('Access-Control-Allow-Headers', '*');

        if ($this->isPreFlight()) {
            Yii::$app->response->statusCode = 200;
            return [];
        }

        \Yii::$app->controller->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $origin = \Yii::$app->request->getOrigin();
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::class,
            'cors' => [
                'Origin' => [$origin],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Allow' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => []
            ],
        ];
        return $behaviors;
    }

    protected function isPreFlight()
    {
        return Yii::$app->request->isOptions;
    }

    /**
     * Если preflight request, то 200 статус, иначе 404
     *
     * @param string $message
     * @return array
     * @throws NotFoundHttpException
     */
    protected function notFoundResponse(
        string $message = ''
    ): array
    {
        if ($this->isPreFlight()) {
            return [];
        }

        throw new NotFoundHttpException($message);
    }
}