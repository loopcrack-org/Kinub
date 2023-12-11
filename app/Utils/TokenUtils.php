<?php

namespace App\Utils;

use App\Models\UserTokenModel;

class TokenUtils
{
    public static function generateToken($userId)
    {
        $tokenData = [
            'userToken'       => uniqid(),
            'tokenExpiryDate' => date('y-m-d', strtotime(' +1 day')),
            'userId'          => $userId,
        ];

        $userTokenModel = new UserTokenModel();
        $userTokenModel->insert($tokenData);

        return $tokenData['userToken'];
    }

    public static function getUserWithToken($token)
    {
        $userTokenModel = new UserTokenModel();

        return $userTokenModel->join('users', 'users.userId = user_tokens.userId')->where('userToken', $token)->first();
    }

    public static function deleteToken($userId)
    {
        $userTokenModel = new UserTokenModel();

        $userTokenModel->where('userId', $userId)->delete();
    }
}
