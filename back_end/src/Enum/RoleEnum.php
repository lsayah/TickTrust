<?php
namespace App\Enum;

enum RoleEnum: string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_TECHNICIAN = 'ROLE_TECHNICIAN';
    case ROLE_USER = 'ROLE_USER';

    public function label(): string
    {
        return match ($this) {
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_TECHNICIAN => 'Technicien',
            self::ROLE_USER => 'Utilisateur',
        };
    }
}