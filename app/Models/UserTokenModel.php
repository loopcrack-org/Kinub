<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class UserTokenModel extends Model
{
    protected $table         = 'user_tokens';
    protected $primaryKey    = 'userTokenId';
    protected $allowedFields = [
        'userToken',
        'tokenExpiryDate',
        'userId',
    ];

    public static function getTokenDate($token)
    {
        $userTokenModel = new UserTokenModel();
        $tokenDB        = $userTokenModel->where('userToken', $token)->first();

        return new DateTime($tokenDB['tokenExpiryDate']);
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
