<?php

namespace App\Enums;

enum UserRoleEnum: int{
    case ADMIN = 1;
    case SUPERVISOR = 2;
    case USER = 3;
    case VISITANTE = 4;
}
