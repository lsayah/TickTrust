<?php

namespace App\Enum;

enum RoleEnum: string
{
    case ADMIN = 'ROLE_ADMIN';
    case TECHNICIAN = 'ROLE_TECHNICIAN';
    case USER = 'ROLE_USER';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrateur',
            self::TECHNICIAN => 'Technicien',
            self::USER => 'Utilisateur',
        };
    }
}
