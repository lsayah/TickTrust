<?php
// src/Enum/RoleEnum.php
namespace App\Enum;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case TECHNICIAN = 'technician';
    case USER = 'user';

    // Optionnellement, tu peux ajouter des méthodes pour l'affichage ou d'autres fonctionnalités
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrateur',
            self::TECHNICIAN=> 'Technicien',
            self::USER => 'Utilisateur',
        };
    }
}
