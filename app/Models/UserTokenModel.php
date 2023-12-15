<?php

namespace App\Models;

use CodeIgniter\Model;
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
