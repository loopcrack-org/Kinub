<?php

namespace App\Utils;

class TokenGenerator
{
    public static function generateToken()
    {
        return uniqid();
    }
}
