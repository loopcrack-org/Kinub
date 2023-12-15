<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;
use Faker\Core\Uuid;
use Throwable;


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

        return $userTokenModel->where('userId', $userId)->delete();

    public function getNewUserToken(string $userId)
    {
        try {
            $this->db->transException(true)->transStart();
            $this->where('userId', $userId)->delete();

            $tokenData = [
                'userToken'       => substr((new Uuid())->uuid3(), 0, 13),
                'tokenExpiryDate' => date('y-m-d', strtotime(' +1 day')),
                'userId'          => $userId,
            ];

            $this->insert($tokenData);

            $this->db->transCommit();

            return $tokenData['userToken'];
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
