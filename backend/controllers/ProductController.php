<?php

namespace backend\controllers;

use backend\services\ProductService;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;

class ProductController extends ApiController
{
    private $productService;
    public function __construct($id, $module, ProductService $productService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->productService = $productService;
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
    public function actionCreate()
    {
        $postData = \Yii::$app->request->post();
        $productDTO = new \backend\dto\ProductDTO(
            $postData['name'],
            $postData['price'],
            $postData['description'],
            $postData['image'],
        );

        return $this->productService->createProduct($productDTO);
    }
}