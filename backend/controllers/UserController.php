<?php

namespace backend\controllers;

use backend\dto\SignUpDTO;
use common\models\User;
use common\services\TokenAuthBehavior;
use common\services\UserService;
use Yii;
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
        if ($action->id == 'signup'
            || $action->id == 'reset-password'
            || $action->id == 'login'
        ) {
            $this->enableCsrfValidation = false; // disable CSRF validation for this actions
        }
        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

//        $behaviors["authenticator"] = [
//            'class' => TokenAuthBehavior::class,
//        ];
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

        $user = $this->userService->login($email, $password);
        if(!$user) {
            throw new BadRequestHttpException(\Yii::t('app', 'Email or password is incorrect'));
        }

        return [
            'token' => $user->access_token,
            'user' => $user->id
        ];
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
                'access_token' => $user->access_token,
            ];
        } else {
            throw new BadRequestHttpException('Failed to register user.');
        }
    }
//    TODO add logout
//    TODO add reset password
//    TODO add change password
//    TODO add change email
//    TODO add change username
}