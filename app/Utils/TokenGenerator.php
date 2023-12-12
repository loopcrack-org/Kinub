<?php

namespace App\Utils;

use App\Models\UserTokenModel;

class TokenGenerator
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
}
