<?php

namespace backend\controllers;

use backend\dto\LoginDTO;
use backend\dto\SignUpDTO;
use common\services\UserService;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class UserController extends ApiController
{
    private $userService;
    public function __construct($id, $module, UserService $userService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
    }
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors["authenticator"] = [
            'class' => HttpBearerAuth::class,
            'except' => ['sign-up', 'login'],
        ];
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => \yii\web\Response::FORMAT_JSON,
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $postData = Yii::$app->request->post();
        $email = $postData['email'];
        $password = $postData['password'];
        if(!$email || !$password) {
            throw new BadRequestHttpException(\Yii::t('app', 'Email or password is empty'));
        }

        $loginDTO = new LoginDTO();
        $loginDTO->email = $email;
        $loginDTO->password = $password;
        $userLogged = $this->userService->login($loginDTO);
        if(!$userLogged) {
            throw new BadRequestHttpException(\Yii::t('app', 'Email or password is incorrect'));
        }

        return $userLogged;
    }

    // TODO refactor if email validation is needed
    //     (delete access token from signup)
    public function actionSignUp()
    {
        $request = Yii::$app->request;

        $dto = new SignUpDTO();
        $dto->username = $request->post('username');
        $dto->email = $request->post('email');
        $dto->password = $request->post('password');

        if (!$dto->username || !$dto->email || !$dto->password) {
            throw new BadRequestHttpException('Username, email, and password are required.');
        }

        $user = $this->userService->signUp($dto);

        if ($user) {
            return [
                'message' => 'User registered successfully.',
                'registration_data' => $user,
            ];
        } else {
            throw new BadRequestHttpException('Failed to register user.');
        }
    }

    // TODO implement later
    public function actionLogout()
    {
        $this->userService->logout();
        return [
            'message' => 'User logged out successfully.',
        ];
    }
//    TODO add logout
//    TODO add reset password
//    TODO add change password
//    TODO add change email
//    TODO add change username
}