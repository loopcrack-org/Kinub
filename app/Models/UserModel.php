<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userId';
    protected $useAutoIncrement = true;
    protected $returnType = "array";
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "userFirstName",
        "userLastName",
        "userEmail",
        "userPassword",
        "userToken",
        "confirmed",
        "isAdmin"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Callbacks
    protected $beforeUpdate = ["hashPassword"];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['userPassword'])) {
            return $data;
        }

        $data['data']['userPassword'] = password_hash($data['data']['userPassword'], PASSWORD_BCRYPT);

        return $data;
    }
}