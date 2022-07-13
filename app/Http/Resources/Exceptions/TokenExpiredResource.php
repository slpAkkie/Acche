<?php

namespace App\Http\Resources\Exceptions;

final class TokenExpiredResource extends CommonErrorResource
{
    public function __construct()
    {
        parent::__construct('Токен более не действителен', 401);
    }
}
