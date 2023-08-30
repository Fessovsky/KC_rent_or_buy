<?php

namespace backend\controllers;


use backend\dto\PurchaseDTO;
use backend\services\PurchaseService;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


class PurchaseController extends ApiController
{
    private $purchaseService;
    public function __construct($id, $module, PurchaseService $purchaseService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->purchaseService = $purchaseService;
    }
    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors["authenticator"] = [
            'class' => HttpBearerAuth::class,
        ];
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => \yii\web\Response::FORMAT_JSON,
        ];
        return $behaviors;
    }

    public function actionBuy()
    {
        $postData = \Yii::$app->request->post();
        $purchaseDTO = new PurchaseDTO(
            $postData['user_id'],
            $postData['product_id']
        );
        return $this->purchaseService->makePurchase($purchaseDTO);
    }

    public function actionCheckAvailability($id)
    {
        return $this->purchaseService->checkAvailability($id);
    }
}