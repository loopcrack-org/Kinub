<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
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
            $this->db->transStart();
            $oldTokenDeleted = $this->where('userId', $userId)->delete();

            if (! $oldTokenDeleted) {
                throw new Exception('Ha ocurrido un error al eliminar el token del usuario');
            }

            $tokenData = [
                'userToken'       => substr((new Uuid())->uuid3(), 0, 13),
                'tokenExpiryDate' => date('y-m-d', strtotime(' +1 day')),
                'userId'          => $userId,
            ];

            if ($this->insert($tokenData) === false) {
                throw new Exception('Ha ocurrido un error al generar el nuevo token');
            }

            $this->db->transComplete();

            return $tokenData['userToken'];
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
