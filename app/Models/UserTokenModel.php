<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTokenModel extends Model
{
    protected $table         = 'user_tokens';
    protected $primaryKey    = 'userTokenId';
    protected $allowedFields = [
        'userToken',
        'tokenExpiryDate',
        'userId',
    ];
}
