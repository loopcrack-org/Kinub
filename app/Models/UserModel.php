<?php

namespace App\Models;

use CodeIgniter\Model;

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

    public function resetPassword()
    {
    }
}
