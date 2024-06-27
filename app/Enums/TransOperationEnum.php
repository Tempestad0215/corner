<?php

namespace App\Enums;

Enum TransOperationEnum: int
{
    case ENTRADA = 1;
    case SALIDA = 2;
    case ACTUALIZACION = 3;
    case ELIMINACION = 4;
}
