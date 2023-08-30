<?php

namespace common\services;

use backend\dto\LoginDTO;
use backend\dto\SignUpDTO;
use common\models\User;
use yii\web\BadRequestHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\UnauthorizedHttpException;

final class UserService
{
    public function login(LoginDTO $loginDTO)
    {
        if (!$loginDTO->username) {
            $user = User::findByEmail($loginDTO->email);
        }
        if (!$loginDTO->email) {
            $user = User::findByUsername($loginDTO->username);
        }

        if (!$user || !$user->validatePassword($loginDTO->password)) {
            throw new UnauthorizedHttpException('Invalid username or password.');
        }

        $user->generateAccessToken();
        if ($user->save()) {
            return [
                "success" => true,
                'user' => [
                    $user['id'],
                    $user['access_token']
                ]
            ];
        }

        return ["success" => false];
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function signUp(SignUpDTO $signUpDTO)
    {
        if (User::findByEmail($signUpDTO->email)) {
            throw new BadRequestHttpException(\Yii::t('app', 'User with this email already exists'));
        }
        $user = new User();
        $user->email = $signUpDTO->email;
        $user->setPassword($signUpDTO->password);
        $user->generateAccessToken();
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        if ($user->save()) {
            return [
                $user['id'],
                $user['access_token']
            ];
        }
        throw new ServerErrorHttpException(\Yii::t('app', 'User not created'));
    }

}