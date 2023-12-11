<?php

namespace App\Models;

use CodeIgniter\Model;
use Throwable;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'userId';
    protected $allowedFields = [
        'userFirstName',
        'userLastName',
        'userEmail',
        'userPassword',
        'confirmed',
        'isAdmin',
    ];

    // Callbacks
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['userPassword'])) {
            return $data;
        }

        $data['data']['userPassword'] = password_hash($data['data']['userPassword'], PASSWORD_BCRYPT);

        return $data;
    }

    public function updatePassword($userId, $newPassword, $isConfirmed)
    {
        try {
            $this->db->transStart();
            if ($isConfirmed) {
                $this->update($userId, [
                    'userPassword' => $newPassword,
                ]);
            } else {
                $this->update($userId, [
                    'userPassword' => $newPassword,
                    'confirmed'    => 1,
                ]);
            }

            $userTokenModel = new UserTokenModel();

            $userTokenModel->where('userId', $userId)->delete();
            $this->db->transComplete();
        } catch (Throwable $th) {
            $this->db->transRollback();

            throw $th;
        }
    }
}
